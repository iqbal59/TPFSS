<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/**
 * Support Controller
 *
 * @author Shahzaib
 */
class Support extends MY_Controller {
    
    /**
     * Class Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->area = 'kbm/support';
        
        $this->load->model( 'Support_model' );
        $this->load->model( 'washing_model' );
        $this->load->library( 'pagination' );
    }
    

    public function index()
    {
        $this->load->model( 'Support_model' );
        
        $data['data']['popular_topics'] = $this->Support_model->popular_topics();
        $data['view'] = 'welcome';
        
        $this->load_public_template( $data, false );
    }
    

    
    /**
     * Create Guest Ticket Page
     *
     * @return  void
     * @version 1.6
     */
    public function create_ticket()
    {
        if ( db_config( 'sp_guest_ticketing' ) == 0 )
        {
            env_redirect( 'login' );
        }
        
        $this->load->model( 'Custom_field_model' );
        
        $data['data']['gr_field'] = true;
        $data['data']['departments'] = $this->Support_model->departments( 1 );
        $data['data']['fields'] = $this->Custom_field_model->custom_fields( 'ASC' );
        $data['data']['form_class'] = 'mb-3';
        $data['data']['label_required_class'] = 'text-danger';
        $data['title'] = lang( 'create_ticket' );
        $data['view'] = 'create_ticket';
        
        $this->load_public_template( $data, false );
    }
    
    /**
     * Guest Ticket Page
     *
     * @param   string  $security_key
     * @param   integer $id
     * @return  void
     * @version 1.4
     */
    public function guest_ticket( $security_key = '', $id = 0 )
    {
        if ( empty( $security_key ) || empty( $id ) ) show_404();
        
        $ticket = $this->Support_model->guest_ticket( $security_key, $id );
        
        if ( empty( $ticket ) ) show_404();
        
        $this->load->model( 'Custom_field_model' );
        
        $replies = $this->Support_model->tickets_replies( $ticket->id );
        
        if ( ( $ticket->sub_status == 2 || ( $ticket->sub_status == 3 && $ticket->last_reply_area != 2 ) ) && $ticket->is_read == 0 )
        {
            $this->Support_model->update_ticket( ['is_read' => 1], $ticket->id, false );
        }
        
        $data['data']['gr_field'] = true;
        $data['data']['security_key'] = $security_key;
        $data['data']['ticket'] = $ticket;
        $data['data']['replies'] = $replies;
        $data['data']['fields'] = $this->Custom_field_model->custom_fields_data( $ticket->id );
        $data['title'] = sub_title( lang( 'ticket' ), $ticket->id );
        $data['view'] = 'guest_ticket';
        
        $this->load_public_template( $data, false );
    }
    
    /**
     * Knowledge Base Category Page
     *
     * @param  string $parent
     * @param  string $child
     * @return void
     */
    public function kb_category( $parent = '', $child = '' )
    {
        $_parent = false;
        
        if ( empty( $child ) ) $slug = do_secure( $parent );
        else
        {
            $slug = do_secure( $child );
            $_parent = true;
        }
        
        $ids = [];
        $id = $this->Support_model->articles_category_id_by_slug( $slug, $_parent );
        
        if ( empty( $id ) ) show_404();
        
        $config['per_page'] = PER_PAGE_RESULTS;
        $ids[] = $id;
        
        if ( empty( $child ) )
        {
            $categories = $this->Support_model->articles_subcategories( $id );
            $base_url = get_kb_category_slug( do_secure( $parent ) );
            $offset = get_offset( $config['per_page'], 3 );
            
            if ( ! empty( $categories ) )
            {
                $to_merge = array_column( $categories, 'id' );
                $ids = array_merge( $ids, $to_merge );
            }
        }
        else
        {
            $base_url = get_kb_category_slug( do_secure( $parent ), do_secure( $child ) );
            $offset = get_offset( $config['per_page'] );
        }
        
        $config['base_url'] = env_url( $base_url );
        
        $config['total_rows'] = $this->Support_model->articles_by_filter([
            'ids' => $ids,
            'count' => true
        ]);
        
        $this->pagination->initialize( $config );
        $data['data']['pagination'] = $this->pagination->create_links();
        
        $data['data']['articles'] = $this->Support_model->articles_by_filter([
            'ids' => $ids,
            'limit' => $config['per_page'],
            'offset' => $offset
        ]);
        
        $this->Support_model->update_articles_category_views( $id );
        
        $category = get_articles_category_data( $id );
        $data['meta_description'] = $category->meta_description;
        $data['meta_keywords'] = $category->meta_keywords;
        $data['title'] = $category->name;
        $data['data']['category'] = $category;
        $data['view'] = 'articles_category';
        
        $this->load_public_template( $data, false );
    }
    
    /**
     * Articles Search Page
     *
     * @return void
     */
    public function search()
    {
        $searched = do_secure( get( 'query' ) );
        $config['base_url'] = env_url( 'search' );
        $config['per_page'] = PER_PAGE_RESULTS;
        $offset = get_offset( $config['per_page'], 2 );
        
        $config['total_rows'] = $this->Support_model->articles_by_filter([
            'searched' => $searched,
            'count' => true
        ]);
        
        $this->pagination->initialize( $config );
        $data['data']['pagination'] = $this->pagination->create_links();
        
        $data['data']['articles'] = $this->Support_model->articles_by_filter([
            'searched' => $searched,
            'limit' => $config['per_page'],
            'offset' => $offset
        ]);
        
        $data['data']['searched'] = $searched;
        $data['data']['found_count'] = $config['total_rows'];
        $data['title'] = lang( 'search' );
        $data['view'] = 'search';
        
        $this->load_public_template( $data, false );
    }
    
    /**
     * Article Page
     *
     * @param  string $slug
     * @return void
     */
    public function article( $slug = '' )
    {
        //$visibility = ( $this->zuser->has_permission( 'knowledge_base' ) ) ? null : 1;
        $visibility=1;
        $article = $this->Support_model->article_by_slug( do_secure( $slug ), $visibility );
        
        if ( empty( $article ) ) show_404();
        
        $id = $article->category_id;
        $vote_status = $this->Support_model->am_i_voted_article( $article->id );
        $ids = [$id];
        
        $this->Support_model->update_article_views( $article->id );
        
        $category = $this->Support_model->articles_category( $article->category_id );
        $parent_id = $category->parent_id;
        
        if ( $parent_id != null ) $ids[] = $parent_id;
        else
        {
            $subcategories = $this->Support_model->articles_subcategories( $id );
            
            if ( ! empty( $subcategories ) )
            {
                $to_merge = array_column( $subcategories, 'id' );
                $ids = array_merge( $ids, $to_merge );
            }
        }
        
        $related = $this->Support_model->related_articles( $article->id, $ids );
        


        $data['data']['voted'] = $vote_status;
        $data['data']['related'] = $related;
        $data['data']['article'] = $article;
        $data['meta_description'] = $article->meta_description;
        $data['meta_keywords'] = $article->meta_keywords;
        $data['title'] = $article->title;
        $data['view'] = 'article';
        
        $this->load_public_template( $data, false );
    }


    public function washing_article( $slug = '' )
    {
    //     //$visibility = ( $this->zuser->has_permission( 'knowledge_base' ) ) ? null : 1;
    //     $visibility=1;
    //     //$article = $this->Support_model->washing_article_by_slug( do_secure( $slug ), $visibility );
    //     //$chemical = $this->Support_model->chemical_articles( $article->id);
        
    //    // if ( empty( $article ) ) show_404();
        
    //   //  print_r($article);

    //     //$id = $article->category_id;
    //     // $vote_status = $this->Support_model->am_i_voted_article( $article->id );
    //     // $ids = [$id];
        
    //     // $this->Support_model->update_article_views( $article->id );
        
    //     // $category = $this->Support_model->articles_category( $article->category_id );
    //     // $parent_id = $category->parent_id;
        
    //     if ( $parent_id != null ) $ids[] = $parent_id;
    //     else
    //     {
    //         //$subcategories = $this->Support_model->articles_subcategories( $id );
            
    //         if ( ! empty( $subcategories ) )
    //         {
    //             $to_merge = array_column( $subcategories, 'id' );
    //             $ids = array_merge( $ids, $to_merge );
    //         }
    //     }
   

    $machineId=$this->input->get('machine_id');
    $garment=$this->input->get('garment');
    $fabric=$this->input->get('fabric');
    $embellishment=$this->input->get('embellishment');
    $color=$this->input->get('color');

        if( $machineId && $garment  &&  $fabric){

            $data['data']['article']=$this->washing_model->getPublicWashingArticle($garment,  $fabric, $embellishment, $color, $machineId);
            
            
            $data['data']['washAndDryProgram']=$this->washing_model->getPublicWashingProgram($machineId,  $data['data']['article']->id);
            
            //print_r($data['data']['washAndDryProgram']);
            
            if($data['data']['washAndDryProgram']->wash_chemical_ids)
            $data['data']['articleChemical'] = $this->washing_model->get_article_wahsing_chemical($data['data']['washAndDryProgram']->wash_chemical_ids);
           

            $data['data']['machineId']=$this->input->get('machine_id');
            $data['data']['garment']=$this->input->get('garment');
            $data['data']['fabric']=$this->input->get('fabric');
            $data['data']['embellishment']=$this->input->get('embellishment');
            $data['data']['color']=$this->input->get('color');
        }


        

        
        // $related = $this->Support_model->related_articles( $article->id, $ids );
        $data['data']['machines']=$this->washing_model->getModel('tbl_machine', 'name', 'asc');
        $data['data']['garments']=$this->washing_model->getModel('tbl_garments', 'name', 'asc');
        $data['data']['fabrics']=$this->washing_model->getModel('tbl_fabrics', 'name', 'asc');
        $data['data']['embellishments']=$this->washing_model->getModel('tbl_embellishments', 'name', 'asc');
        $data['data']['colors']=$this->washing_model->getModel('tbl_colors', 'name', 'asc');
        $data['data']['waters']=$this->washing_model->getModel('tbl_water_temp', 'name', 'asc');
        $data['data']['voted'] = $vote_status;
        $data['data']['related'] = $related;
       // $data['data']['article'] = $article;
        //$data['data']['articleChemical'] = $chemical;
        $data['meta_description'] = $article->meta_description;
        $data['meta_keywords'] = $article->meta_keywords;
        $data['title'] = $article->title;
        $data['view'] = 'washing_article';
        
        $this->load_public_template( $data, false );
    }
    
    /**
     * Article Voting Input Handling ( Action ).
     *
     * @param  string  $type
     * @param  integer $id
     * @return void
     */
    public function article_vote( $type = '', $id = 0 )
    {
        if ( ! in_array( $type, ['y', 'n'] ) ) r_error( 'invalid_req' );
        
        $id = intval( $id );
        $type = ( $type === 'y' ) ? 'helpful' : 'not_helpful';
        $article = $this->Support_model->article( $id );
        
        if ( empty( $article ) ) r_error( 'invalid_req' );
        
        if ( ! $this->Support_model->am_i_voted_article( $id ) )
        {
            if ( $this->Support_model->add_article_vote( $id, $type ) )
            {
                $article->{$type} = $article->{$type} + 1;
                $count = ( $article->helpful + $article->not_helpful );
                $text = html_escape( sprintf( lang( 'found_helpful' ), $article->helpful, $count ) );
                
                r_success_voted( '[ ' . $text . ' ]' );
            }
            
            r_error( 'went_wrong' );
        }
        
        r_error( 'already_voted' );
    }
    
    /**
     * FAQs Page
     *
     * @return void
     */
    public function faqs()
    {
        $data['data']['categories'] = get_faqs_categories( 'ASC' );
        $data['title'] = lang( 'faqs' );
        $data['view'] = 'faqs';
        
        $this->load_public_template( $data, false );
    }
}