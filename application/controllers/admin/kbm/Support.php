<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/**
 * Support Controller ( Admin )
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
        
        // if ( ! $this->zuser->is_logged_in )
        // {
        //     env_redirect( 'login' );
        // }
        
        $this->sub_area = 'kbm';
        $this->area = 'admin';
        
       $this->load->model( 'Support_model' );
       $this->load->library('form_validation');
        $this->load->library( 'pagination' );
    }


    public function index(){
        $data['view'] = 'dashboard';
        $this->load_panel_template($data);
    }
    
    /**
     * Chats Page
     *
     * @param   string $type
     * @return  void
     * @version 1.4
     */
    public function chats( $type = '' )
    {
        check_page_authorization( 'chats' );
        
        $this->set_admin_reference( 'chats' );
        
        $to_fetch = [];
        $to_count = [];
        
        $config['per_page'] = PER_PAGE_RESULTS_PANEL;
        $offset = get_offset( $config['per_page'] );
        $to_fetch['limit'] = $config['per_page'];
        $to_count['count'] = true;
        $data['data']['assigned'] = false;
        $to_fetch['assigned'] = false;
        $to_count['assigned'] = false;
        $searched = do_secure( get( 'search' ) );
        $reply_status = intval( get( 'reply_status' ) );
        
        $to_fetch['searched'] = $searched;
        $to_count['searched'] = $searched;
        $to_fetch['reply_status'] = $reply_status;
        $to_count['reply_status'] = $reply_status;
        
        if ( $type === 'all' )
        {
            $config['base_url'] = env_url( 'admin/chats/all' );
            $data['title'] = lang( 'all_chats' );
        }
        else if ( $type === 'active' )
        {
            $config['base_url'] = env_url( 'admin/chats/active' );
            $data['title'] = lang( 'active_chats' );
            $to_fetch['status'] = 1;
            $to_count['status'] = 1;
        }
        else if ( $type === 'ended' )
        {
            $config['base_url'] = env_url( 'admin/chats/ended' );
            $data['title'] = lang( 'ended_chats' );
            $to_fetch['status'] = 0;
            $to_count['status'] = 0;
        }
        else if ( $type === 'assigned' )
        {
            $config['base_url'] = env_url( 'admin/chats/assigned' );
            $data['title'] = lang( 'assigned_chats' );
            $data['data']['assigned'] = true;
            $to_fetch['assigned'] = true;
            $to_count['assigned'] = true;
        }
        else
        {
            env_redirect( get_related_dashboard() );
        }
        
        $to_fetch['offset'] = $offset;
        $config['total_rows'] = $this->Support_model->chats( $to_count );
        
        $this->pagination->initialize( $config );
        
        $data['data']['pagination'] = $this->pagination->create_links();
        $data['data']['chats'] = $this->Support_model->chats( $to_fetch );
        $data['data']['card_title'] = $data['title'];
        $data['data']['main_controller'] = 'support';
        $data['delete_method'] = 'delete_chat';
        $data['view'] = 'chats';
        
        $this->load_panel_template( $data );
    }
    
    /**
     * Chat Page
     *
     * @param   integer $id
     * @return  void
     * @version 1.4
     */
    public function chat( $id = 0 )
    {
        check_page_authorization( 'chats' );
        
        $chat = $this->Support_model->chat( intval( $id ) );
        
        if ( empty( $chat ) ) env_redirect( 'admin/chats/all' );
        
        $this->set_admin_reference( 'chats' );

        $replies = $this->Support_model->chat_replies( $chat->id );
        $user_id = $this->zuser->get( 'id' );
        
        if ( $chat->is_read_assigned == 0 && ( $chat->assigned_to == $user_id && get( 'read' ) != 'false' ) )
        {
            $this->Support_model->update_chat( ['is_read_assigned' => 1], $chat->id, false );
        }
        
        if ( ( $chat->sub_status == 1 && $chat->is_read == 0 && ( $chat->assigned_to == null || $chat->assigned_to == $user_id ) ) )
        {
            $this->Support_model->update_chat( ['is_read' => 1], $chat->id, false );
        }
        
        $data['title'] = $chat->id;
        $data['data']['scripts'] = [get_assets_path( 'panel/js/chat_script.js?v=' . v_combine() )];
        $data['data']['canned_replies'] = $this->Support_model->canned_replies();
        $data['data']['chat'] = $chat;
        $data['data']['replies'] = $replies;
        $data['data']['main_controller'] = 'support';
        $data['view'] = 'chat';
        
        $this->load_panel_template( $data );
    }
    
    /**
     * Tickets Departments Page
     *
     * @param  integer $id
     * @param  string  $type
     * @return void
     */
    public function departments( $id = 0, $type = 'tickets' )
    {
        check_page_authorization( 'departments' );
        
        $this->set_admin_reference( 'tickets_and_chats' );
        
        if ( ! empty( $id ) )
        {
            $id = intval( $id );
            $department = $this->Support_model->department( $id );
            
            if ( ! empty( $department ) )
            {
                if ( ! in_array( $type, ['tickets', 'chats'] ) )
                {
                    env_redirect( 'admin/support/departments' );
                }
                
                $data['title'] = sub_title( lang( 'departments' ), $department->name );
                $config['per_page'] = PER_PAGE_RESULTS_PANEL;
                $offset = get_offset( $config['per_page'], 6 );
                $config['base_url'] = env_url( "admin/support/departments/{$id}/{$type}" );
                
                if ( $type === 'tickets' )
                {
                    check_page_authorization( 'tickets' );                       

                    $data['delete_method'] = 'delete_ticket';
                    $data['view'] = 'department_tickets';
                }
                else
                {
                    check_page_authorization( 'chats' );
                    
                    $data['delete_method'] = 'delete_chat';
                    $data['view'] = 'department_chats';
                }
                
                $total_rows = ['department_id' => $id, 'count' => true];
                $rows_data = ['department_id' => $id, 'limit' => $config['per_page'], 'offset' => $offset];
                
                if ( $type === 'chats' )
                {
                    if ( ! $this->zuser->has_permission( 'all_chats' ) )
                    {
                        $total_rows['assigned'] = true;
                        $rows_data['assigned'] = true;
                    }
                }
                
                $all_rows = $this->Support_model->{$type}( $total_rows );
                
                $config['total_rows'] = $all_rows;
                
                if ( $type == 'tickets' )
                {
                    $data['data']['all_tickets'] = $all_rows;
            
                    $total_rows['status'] = 1;
                    $data['data']['opened_tickets'] = $this->Support_model->tickets( $total_rows );
                    
                    $total_rows['status'] = 0;
                    $data['data']['closed_tickets'] = $this->Support_model->tickets( $total_rows );
                }
                else
                {
                    $data['data']['all_chats'] = $all_rows;
            
                    $total_rows['status'] = 1;
                    $data['data']['active_chats'] = $this->Support_model->chats( $total_rows );
                    
                    $total_rows['status'] = 0;
                    $data['data']['ended_chats'] = $this->Support_model->chats( $total_rows );
                }
                
                $data['data'][$type] = $this->Support_model->{$type}( $rows_data );
                
                $this->pagination->initialize( $config );
                
                $data['data']['pagination'] = $this->pagination->create_links();
                $data['data']['card_title'] = $department->name;
                $data['data']['main_controller'] = 'support';
            }
            else
            {
                env_redirect( 'admin/support/departments' );
            }
        }
        else
        {
            $data['data']['departments'] = $this->Support_model->departments();
            $data['delete_method'] = 'delete_department';
            $data['title'] = lang( 'departments' );
            $data['view'] = 'departments';
        }
        
        $this->load_panel_template( $data );
    }
    
    /**
     * Canned Replies Page
     *
     * @return void
     */
    public function canned_replies()
    {
        check_page_authorization( 'canned_replies' );
        
        $this->set_admin_reference( 'tickets_and_chats' );
        
        $config['base_url'] = env_url( 'admin/support/canned_replies' );
        $config['total_rows'] = $this->Support_model->canned_replies( true );
        $config['per_page'] = PER_PAGE_RESULTS_PANEL;
        $offset = get_offset( $config['per_page'] );
        
        $this->pagination->initialize( $config );
        $data['data']['pagination'] = $this->pagination->create_links();
        
        $data['data']['canned_replies'] = $this->Support_model->canned_replies(
            false,
            $config['per_page'],
            $offset
        );
        
        $data['delete_method'] = 'delete_canned_reply';
        $data['title'] = lang( 'canned_replies' );
        $data['view'] = 'canned_replies';
        
        $this->load_panel_template( $data );
    }
    
    /**
     * FAQs Page
     *
     * @param  string $page
     * @return void
     */
    public function faqs( $page = 'list' )
    {
        check_page_authorization( 'faqs' );
        
        if ( $page === 'list' )
        {
            $config['base_url'] = env_url( 'admin/support/faqs/list' );
            $config['total_rows'] = $this->Support_model->faqs( true );
            $config['per_page'] = PER_PAGE_RESULTS_PANEL;
            $offset = get_offset( $config['per_page'], 5 );
            
            $this->pagination->initialize( $config );
            $data['data']['pagination'] = $this->pagination->create_links();
            
            $data['data']['faqs'] = $this->Support_model->faqs(
                false,
                $config['per_page'],
                $offset
            );
            
            $data['delete_method'] = 'delete_faq';
            $data['title'] = lang( 'faqs' );
            $data['view'] = 'faqs';
        }
        else if ( $page === 'categories' )
        {
            $page_title = sub_title( lang( 'faqs' ), lang( 'categories' ) );
            $categories = $this->Support_model->faqs_categories();
            
            $data['data']['faqs_categories'] = $categories;
            $data['delete_method'] = 'delete_faqs_category';
            $data['title'] = $page_title;
            $data['view'] = 'faqs_categories';
        }
        else
        {
            env_redirect( 'admin/support/faqs' );
        }
        
        $this->set_admin_reference( 'others' );
        $this->load_panel_template( $data );
    }
    
    /**
     * Tickets Pages
     *
     * @param  string $type
     * @return void
     */
    private function tickets( $type = 'all' )
    {
        check_page_authorization( 'tickets' );
        
        $this->set_admin_reference( 'tickets' );
        
        $to_fetch = [];
        $to_count = [];
        
        $config['per_page'] = PER_PAGE_RESULTS_PANEL;
        $offset = get_offset( $config['per_page'] );
        $to_fetch['limit'] = $config['per_page'];
        $to_count['count'] = true;
        $data['data']['assigned'] = false;
        $searched = do_secure( get( 'search' ) );
        $reply_status = intval( get( 'reply_status' ) );
        $priority = do_secure_l( get( 'priority' ) );
        
        $to_fetch['searched'] = $searched;
        $to_count['searched'] = $searched;
        $to_fetch['reply_status'] = $reply_status;
        $to_count['reply_status'] = $reply_status;
        $to_fetch['priority'] = $priority;
        $to_count['priority'] = $priority;
        
        if ( $type === 'all' )
        {
            $config['base_url'] = env_url( 'admin/tickets/all' );
            $data['title'] = lang( 'all_tickets' );
        }
        else if ( $type === 'opened' )
        {
            $config['base_url'] = env_url( 'admin/tickets/opened' );
            $data['title'] = lang( 'opened_tickets' );
            $to_fetch['status'] = 1;
            $to_count['status'] = 1;
        }
        else if ( $type === 'closed' )
        {
            $config['base_url'] = env_url( 'admin/tickets/closed' );
            $data['title'] = lang( 'closed_tickets' );
            $to_fetch['status'] = 0;
            $to_count['status'] = 0;
        }
        else if ( $type === 'assigned' )
        {
            if ( ! $this->zuser->has_permission( 'all_tickets' ) )
            {
                env_redirect( get_related_dashboard() );
            }
            
            $config['base_url'] = env_url( 'admin/tickets/assigned' );
            $data['title'] = lang( 'assigned_tickets' );
            $data['data']['assigned'] = true;
            $to_fetch['assigned'] = true;
            $to_count['assigned'] = true;
        }
        else
        {
            env_redirect( get_related_dashboard() );
        }
        
        $to_fetch['offset'] = $offset;
        $config['total_rows'] = $this->Support_model->tickets( $to_count );
        
        $this->pagination->initialize( $config );
        
        $data['data']['pagination'] = $this->pagination->create_links();
        $data['data']['tickets'] = $this->Support_model->tickets( $to_fetch );
        $data['data']['card_title'] = $data['title'];
        $data['data']['main_controller'] = 'support';
        $data['delete_method'] = 'delete_ticket';
        $data['view'] = 'tickets';
        
        $this->load_panel_template( $data );
    }
    
    /**
     * All Tickets Page
     *
     * @return void
     */
    public function all_tickets()
    {
        $this->tickets( 'all' );
    }
    
    /**
     * Opened Tickets Page
     *
     * @return void
     */
    public function opened_tickets()
    {
        $this->tickets( 'opened' );
    }
    
    /**
     * Closed Tickets Page
     *
     * @return void
     */
    public function closed_tickets()
    {
        $this->tickets( 'closed' );
    }
    
    /**
     * Assigned Tickets Page
     *
     * @return void
     */
    public function assigned_tickets()
    {
        $this->tickets( 'assigned' );
    }
    
    /**
     * Create Ticket Page
     *
     * @return  void
     * @version 1.1
     */
    public function create_ticket()
    {
        if ( ! $this->zuser->is_logged_in ) env_redirect( 'login' );
        
        check_page_authorization( 'all_tickets' );
        
        $this->load->model( 'User_model' );
        $this->load->model( 'Custom_field_model' );
        
        $this->set_admin_reference( 'tickets' );
        
        $data['data']['departments'] = $this->Support_model->departments();
        $data['data']['customers'] = $this->User_model->active_users();
        $data['data']['fields'] = $this->Custom_field_model->custom_fields( 'ASC' );
        $data['data']['form_class'] = 'form-group';
        $data['data']['label_required_class'] = 'required';
        $data['title'] = lang( 'create_ticket' );
        $data['view'] = 'create_ticket';
        
        $this->load_panel_template( $data );
    }
    
    /**
     * Ticket Page
     *
     * @param  integer $id
     * @return void
     */
    public function ticket( $id = 0 )
    {
        check_page_authorization( 'tickets' );
        
        $this->load->model( 'Custom_field_model' );
        
        $ticket = $this->Support_model->ticket( intval( $id ) );
        
        if ( empty( $ticket ) ) env_redirect( 'admin/tickets/all' );

        $replies = $this->Support_model->tickets_replies( $ticket->id );
        $user_id = $this->zuser->get( 'id' );
        
        if ( $ticket->is_read_assigned == 0 && ( $ticket->assigned_to == $user_id && get( 'read' ) != 'false' ) )
        {
            $this->Support_model->update_ticket( ['is_read_assigned' => 1], $ticket->id, false );
        }
        
        if ( ( $ticket->sub_status == 1 || ( $ticket->sub_status == 3 && $ticket->last_reply_area != 1 ) ) &&
        $ticket->is_read == 0 && ( $ticket->assigned_to == null || $ticket->assigned_to == $user_id ) )
        {
            $this->Support_model->update_ticket( ['is_read' => 1], $ticket->id, false );
        }
        
        $this->set_admin_reference( 'tickets' );
        
        $data['title'] = $ticket->id;
        
        $data['data']['history'] = $this->Support_model->ticket_history([
            'ticket_id' => $id,
            'limit' => 3
        ]);
        
        $data['data']['history_count'] = $this->Support_model->ticket_history([
            'ticket_id' => $id,
            'count' => true
        ]);
        
        $data['data']['canned_replies'] = $this->Support_model->canned_replies();
        $data['data']['fields'] = $this->Custom_field_model->custom_fields_data( $ticket->id );
        $data['data']['ticket'] = $ticket;
        $data['data']['replies'] = $replies;
        $data['data']['main_controller'] = 'support';
        $data['delete_method'] = 'delete_reply';
        $data['view'] = 'ticket';
        
        $this->load_panel_template( $data );
    }
    
    /**
     * Ticket History Page
     *
     * @param  integer $id
     * @return void
     */
    public function ticket_history( $id = 0 )
    {
        check_page_authorization( 'tickets' );

        $ticket = $this->Support_model->ticket( intval( $id ) );

        if ( empty( $ticket ) ) env_redirect( 'admin/tickets/all' );
        
        $this->set_admin_reference( 'tickets' );
        
        $config['base_url'] = env_url( 'admin/tickets/history/' . $id . '/page' );
        
        $config['total_rows'] = $this->Support_model->ticket_history([
            'ticket_id' => $id,
            'count' => true
        ]);
        
        $config['per_page'] = PER_PAGE_RESULTS_PANEL;
        $offset = get_offset( $config['per_page'], 6 );
        
        $this->pagination->initialize( $config );
        
        $data['data']['pagination'] = $this->pagination->create_links();
        
        $data['title'] = sub_title( lang( 'ticket_history' ), $ticket->id );
        
        $data['data']['history'] = $this->Support_model->ticket_history([
            'ticket_id' => $id,
            'limit' => $config['per_page'],
            'offset' => $offset
        ]);
        
        $data['view'] = 'ticket_history';
        
        $this->load_panel_template( $data );
    }
    
    /**
     * Articles Categories ( Knowledge Base ) Page.
     *
     * @param  string $type
     * @return void
     */
    public function articles_categories( $type = 'parent' )
    {
       // check_page_authorization( 'knowledge_base' );
        
        if ( $type === 'parent' )
        {
            $page_title = sub_title( lang( 'knowledge_base' ), lang( 'categories' ) );
            
            $data['data']['categories'] = $this->Support_model->articles_categories();
            $data['title'] = $page_title;
            $data['view'] = 'knowledge_base/categories';
        }
        else if ( $type === 'sub' )
        {
            $page_title = sub_title( lang( 'knowledge_base' ), lang( 'subcategories' ) );
            
            $data['data']['categories'] = $this->Support_model->articles_categories( 'sub' );
            $data['title'] = $page_title;
            $data['view'] = 'knowledge_base/subcategories';
        }
        else
        {
            env_redirect( get_related_dashboard() );
        }
        
        $data['delete_method'] = 'delete_articles_category';
        $data['data']['main_controller'] = 'kbm/support';
        
        $this->set_admin_reference( 'others' );
        $this->load_panel_template( $data );
    }
    
    /**
     * Articles ( Knowledge Base ) Page.
     *
     * @param  string  $type
     * @param  integer $id
     * @return void
     */
    public function articles( $type = 'list', $id = 0 )
    {
        //check_page_authorization( 'knowledge_base' );
        
        $this->set_admin_reference( 'others' );
        
        $page_title = sub_title( lang( 'knowledge_base' ), lang( 'articles' ) );
        
        if ( $type === 'list' )
        {
            $options = [];
            $options['searched'] = do_secure( get( 'search' ) );
            $options['visibility'] = do_secure_l( get( 'visibility' ) );
            
            $config['base_url'] = env_url( 'admin/knowledge_base/articles/list' );
            $config['total_rows'] = $this->Support_model->articles( true, 0, 0, $options );
            $config['per_page'] = PER_PAGE_RESULTS_PANEL;
            $offset = get_offset( $config['per_page'], 5 );
            
            $this->pagination->initialize( $config );
            $data['data']['pagination'] = $this->pagination->create_links();
            
            $data['data']['articles'] = $this->Support_model->articles(
                false,
                $config['per_page'],
                $offset,
                $options
            );
            
            $data['data']['main_controller'] = 'kbm/support';
            $data['delete_method'] = 'delete_article';
            $data['view'] = 'knowledge_base/articles';
        }
        else if ( $type === 'new' )
        {
            $page_title = sub_title( $page_title, lang( 'new_article' ) );
            $data['view'] = 'knowledge_base/new_article';
        }
        else
        {
            $article = $this->Support_model->article( $id );
            
            if ( empty( $article ) ) env_redirect( 'admin/knowledge_base/articles' );
        
            $page_title = sub_title( $page_title, lang( 'edit_article' ) );
            $data['data']['article'] = $article;
            $data['view'] = 'knowledge_base/edit_article';
        }
        
        $data['title'] = $page_title;
        $this->load_panel_template( $data );
    }


    public function ticket_resend_access()
    {
        check_action_authorization( 'tickets' );
        
        if ( ! is_email_settings_filled() ) r_error( 'missing_email_config_a' );
        
        $id = intval( post( 'id' ) );
        $ticket = $this->Support_model->ticket( $id );
        
        if ( empty( $ticket ) ) r_error( 'invalid_req' );
        
        $hook = 'resend_ticket_access';
        $template = $this->Tool_model->email_template_by_hook_and_lang( $hook, get_language() );
        
        if ( empty( $template ) ) r_error( 'missing_template' );
        
        $subject = $template->subject;
        
        $message = replace_placeholders( $template->template, [
            '{TICKET_URL}' => env_url( 'ticket/guest/' . $ticket->security_key . "/{$id}" ),
            '{TICKET_ID}' => $id,
            '{SITE_NAME}' => db_config( 'site_name' )
        ]);
        
        $email_address = $ticket->email_address;
        
        if ( empty( $email_address ) ) r_error( 'invalid_req' );
        
        $this->load->library( 'ZMailer' );

        if ( $this->zmailer->send_email( $email_address, $subject, $message ) )
        {
            log_ticket_activity( 'ticket_access_resent', $id );
            
            r_success_cm( 'email_sent' );
        }
        
        r_error( 'failed_email_status' );
    }
    
    /**
     * Add Chat Reply Input Handling.
     *
     * @return void
     */
    public function add_chat_reply()
    {
        check_action_authorization( 'chats' );
        
        $chat_id = intval( post( 'id' ) );
        $chat = $this->Support_model->chat( $chat_id );
        $my_id = $this->zuser->get( 'id' );
        $to_update = [];
        
        if ( empty( $chat ) ) r_error( 'invalid_req' );
        
        if ( $chat->status == 0 ) r_error( 'chat_ended' );
        
        if ( $this->form_validation->run( 'add_reply' ) )
        {
            $data = [
                'chat_id' => $chat_id,
                'user_id' => $my_id,
                'area' => 1,
                'message' => do_secure( post( 'reply' ), true ),
                'replied_at' => time()
            ];
            
            $to_update['sub_status'] = 2;
            
            $id = $this->Support_model->add_chat_reply( $data );
            
            if ( ! empty( $id ) )
            {
                $this->Support_model->update_chat( $to_update, $chat_id );
                
                r_reset_form();
            }
            
            r_error( 'went_wrong' );
        }
        
        d_r_error( form_error( 'reply' ) );
    }
    
    /**
     * Chat Subject ( Read More ) Response.
     *
     * @return  void
     * @version 1.4
     */
    public function chat_subject()
    {
        check_action_authorization( 'chats' );
        
        $id = intval( post( 'id' ) );
        $data = $this->Support_model->chat( $id );
        
        if ( ! empty( $data ) )
        {
            $data = [
                'detail' => $data->subject,
                'type' => lang( 'subject' ),
                'id' => $id
            ];
            
            display_view( 'admin/responses/read_more', $data );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Get Chat Messages
     *
     * @param   integer $id
     * @return  void
     * @version 1.4
     */
    public function get_chat_messages( $id = 0 )
    {
        check_action_authorization( 'chats' );
        
        $id = intval( $id );
        
        $chat = $this->Support_model->chat( $id );
        
        if ( ! empty( $chat ) )
        {
            $data['having_replies'] = 'false';
            $last_reply_id = intval( post( 'last_reply_id' ) );
            $replies = $this->Support_model->chat_replies( $id, $last_reply_id );
            $body = ['replies' => $replies];
            
            if ( ! empty( $replies ) ) $data['having_replies'] = 'true';
            
            $data['chat_body'] = read_view( 'admin/responses/chat_body', $body );
            
            r_admin_chat_replies( $data );
        }
    }
    
    /**
     * End Chat
     *
     * @return  void
     * @version 1.4
     */
    public function end_chat()
    {
        check_action_authorization( 'chats' );
        
        $id = intval( post( 'id' ) );
        
        $data = $this->Support_model->chat( $id );
        
        if ( empty( $data ) ) r_error( 'invalid_req' );
        
        if ( $this->Support_model->end_chat( $id ) )
        {
            r_s_jump( "admin/chats/chat/{$id}", 'chat_ended' );
        }
        
        r_error( 'invalid_req' );
    }
    
     /**
     * Delete Chat
     *
     * @return  void
     * @version 1.4
     */
    public function delete_chat()
    {
        check_action_authorization( 'chats' );
        
        $id = intval( post( 'id' ) );
        
        $chat = $this->Support_model->chat( $id );
        
        if ( empty( $chat ) ) r_error( 'invalid_req' );
        
        if ( $this->Support_model->delete_chat( $id ) )
        {
            $this->Support_model->delete_chat_replies( $id );
            
            r_success_remove( $id );
        }
        
        r_error( 'went_wrong' );
    }
    
    /**
     * Ticket Subject ( Read More ) Response.
     *
     * @return  void
     * @version 1.4
     */
    public function ticket_subject()
    {
        check_action_authorization( 'tickets' );
        
        $id = intval( post( 'id' ) );
        $data = $this->Support_model->ticket( $id );
        
        if ( ! empty( $data ) )
        {
            $data = [
                'detail' => $data->subject,
                'type' => lang( 'subject' ),
                'id' => $id
            ];
            
            display_view( 'admin/responses/read_more', $data );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Summernote Image Upload
     *
     * @return  void
     * @version 1.3
     */
    public function sn_image_upload()
    {
        if ( ! empty( $_FILES['file']['name'] ) )
        {
            $this->load->library( 'TumbleFiles' );
            
            $file = $this->tumblefiles->upload_image_file( 'file', 'attachments' );
            
            echo attachments_uploads( $file );
        }
    }
    
    /**
     * Summernote Image Delete
     *
     * @return  void
     * @version 1.3
     */
    public function sn_image_delete()
    {
        $file = do_secure( post( 'file' ) );
        $file = str_replace( base_url(), '', $file );
        $fpp = explode( '/', $file );
        
        if ( ! is_array( $fpp ) || ( sizeof( $fpp ) < 4 ) )
        {
            return false;
        }
        
        if ( $fpp[0] != 'uploads' || $fpp[1] != 'images' || $fpp[2] != 'attachments' )
        {
            return false;
        }
        
        if ( file_exists( $file ) )
        {
            unlink( $file );
        }
    }
    
    /**
     * Add Canned Reply Input Handling.
     *
     * @return void
     */
    public function add_canned_reply()
    {
        check_action_authorization( 'canned_replies' );
        
        if ( $this->form_validation->run( 'canned_reply' ) )
        {
            $data = [
                'subject' => do_secure( post( 'subject' ) ),
                'message' => do_secure( post( 'message' ), true ),
                'created_at' => time()
            ];
            
            $id = $this->Support_model->add_canned_reply( $data );
            
            if ( ! empty( $id ) )
            {
                $data['id'] = $id;
                
                $html = read_view( 'admin/responses/add_canned_reply', $data );
                
                r_success_add( $html );
            }
            
            r_error( 'went_wrong' );
        }
        
        d_r_error( validation_errors() );
    }
    
    /**
     * Canned Reply ( Read More ) Response.
     *
     * @return void
     */
    public function canned_reply()
    {
        check_action_authorization( 'canned_replies' );
        
        $id = intval( post( 'id' ) );
        $data = $this->Support_model->canned_reply( $id );
        
        if ( ! empty( $data ) )
        {
            $data = [
                'detail' => $data->message,
                'type' => lang( 'message' ),
                'id' => $id
            ];
            
            display_view( 'admin/responses/read_more', $data );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Get Canned Reply
     *
     * @param  integer $data_id
     * @param  string  $type
     * @return void
     */
    public function get_canned_reply( $data_id = 0, $type = 'ticket' )
    {
        $this->load->model( 'User_model' );
        
        $data_id = intval( $data_id );
        $agent_id = $this->zuser->get( 'id' );
        $id = intval( post( 'reply_id' ) );
        
        if ( empty( $id ) ) d_r_success( '' );
        
        if ( $type === 'ticket' )
        {
            $data = $this->Support_model->ticket( $data_id );
        }
        else if ( $type === 'chat' )
        {
            $data = $this->Support_model->chat( $data_id );
        }
        else
        {
            r_error( 'invalid_req' );
        }
        
        $reply = $this->Support_model->canned_reply( $id );
        $agent = $this->User_model->get_by_id( $agent_id );
        
        if ( empty( $data ) || empty( $reply ) || empty( $agent ) )
        {
            r_error( 'invalid_req' );
        }
        
        $requester_name = $data->first_name . ' ' . $data->last_name;
        
        if ( $data->user_id == null )
        {
            $requester_name = lang( 'customer' );
        }
        
        $message = replace_placeholders( $reply->message, [
            '{REQUESTER_NAME}' => $requester_name,
            '{SUBJECT}' => strip_tags( trim( $data->subject ) ),
            '{AGENT_NAME}' => $agent->first_name . ' ' . $agent->last_name,
            '{SITE_NAME}' => db_config( 'site_name' )
        ]);
        
        d_r_success( $message );
    }
    
    /**
     * Edit Canned Reply ( Response ).
     *
     * @return void
     */
    public function edit_canned_reply()
    {
        check_action_authorization( 'canned_replies' );
        
        if ( ! post( 'id' ) ) r_error( 'invalid_req' );
        
        $data = $this->Support_model->canned_reply( intval( post( 'id' ) ) );
        
        if ( ! empty( $data ) )
        {
            display_view( 'admin/responses/forms/edit_canned_reply', $data );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Update Canned Reply Input Handling.
     *
     * @return void
     */
    public function update_canned_reply()
    {
        check_action_authorization( 'canned_replies' );
        
        if ( $this->form_validation->run( 'canned_reply' ) )
        {
            $id = intval( post( 'id' ) );
            
            $data = [
                'subject' => do_secure( post( 'subject' ) ),
                'message' => do_secure( post( 'message' ), true )
            ];
            
            if ( $this->Support_model->update_canned_reply( $data, $id ) )
            {
                $data = $this->Support_model->canned_reply( $id );
                $html = read_view( 'admin/responses/update_canned_reply', $data );
                
                r_success_replace( $id, $html );
            }
            
            r_error( 'not_updated' );
        }
        
        d_r_error( validation_errors() );
    }
    
    /**
     * Delete Canned Reply
     *
     * @return void
     */
    public function delete_canned_reply()
    {
        check_action_authorization( 'canned_replies' );
        
        $id = intval( post( 'id' ) );
        
        if ( $this->Support_model->delete_canned_reply( $id ) )
        {
            r_success_remove( $id );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Add FAQ Input Handling.
     *
     * @return void
     */
    public function add_faq()
    {
        check_action_authorization( 'faqs' );
        
        if ( $this->form_validation->run( 'faq' ) )
        {
            $data = [
                'question' => do_secure( post( 'question' ) ),
                'answer' => do_secure( post( 'answer' ), true ),
                'category_id' => intval( post( 'category' ) ),
                'visibility' => only_binary( post( 'visibility' ) ),
                'created_at' => time()
            ];
            
            $result = array_search( $data['category_id'], array_column( get_faqs_categories(), 'id' ) );
                
            if ( $result === false ) r_error( 'invalid_req' );
            
            $id = $this->Support_model->add_faq( $data );
            
            if ( ! empty( $id ) )
            {
                $data['id'] = $id;
                
                $html = read_view( 'admin/responses/add_faq', $data );
                
                r_success_add( $html );
            }
            
            r_error( 'went_wrong' );
        }
        
        d_r_error( validation_errors() );
    }
    
    /**
     * FAQ ( Read More ) Response.
     *
     * @param  string $type
     * @return void
     */
    public function faq( $type = '' )
    {
        check_action_authorization( 'faqs' );
        
        $id = intval( post( 'id' ) );
        $data = $this->Support_model->faq( $id );
        
        if ( ! in_array( $type, ['question', 'answer'] ) )
        {
            r_error( 'invalid_req' );
        }
        
        if ( ! empty( $data ) )
        {
            $data = [
                'detail' => $data->{$type},
                'type' => lang( $type ),
                'id' => $id
            ];
            
            display_view( 'admin/responses/read_more', $data );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Edit FAQ ( Response ).
     *
     * @return void
     */
    public function edit_faq()
    {
        check_action_authorization( 'faqs' );
        
        if ( ! post( 'id' ) ) r_error( 'invalid_req' );
        
        $data = $this->Support_model->faq( intval( post( 'id' ) ) );
        
        if ( ! empty( $data ) )
        {
            display_view( 'admin/responses/forms/edit_faq', $data );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Update FAQ Input Handling.
     *
     * @return void
     */
    public function update_faq()
    {
        check_action_authorization( 'faqs' );
        
        if ( $this->form_validation->run( 'faq' ) )
        {
            $id = intval( post( 'id' ) );
            
            $data = [
                'question' => do_secure( post( 'question' ) ),
                'answer' => do_secure( post( 'answer' ), true ),
                'category_id' => intval( post( 'category' ) ),
                'visibility' => only_binary( post( 'visibility' ) ),
            ];
            
            $result = array_search( $data['category_id'], array_column( get_faqs_categories(), 'id' ) );
                
            if ( $result === false ) r_error( 'invalid_req' );
            
            if ( $this->Support_model->update_faq( $data, $id ) )
            {
                $data = $this->Support_model->faq( $id );
                $html = read_view( 'admin/responses/update_faq', $data );
                
                r_success_replace( $id, $html );
            }
            
            r_error( 'not_updated' );
        }
        
        d_r_error( validation_errors() );
    }
    
    /**
     * Delete Canned Reply
     *
     * @return void
     */
    public function delete_faq()
    {
        check_action_authorization( 'faqs' );
        
        $id = intval( post( 'id' ) );
        
        if ( $this->Support_model->delete_faq( $id ) )
        {
            r_success_remove( $id );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Add FAQs Category Input Handling.
     *
     * @return void
     */
    public function add_faqs_category()
    {
        check_action_authorization( 'faqs' );
        
        if ( $this->form_validation->run( 'faqs_category' ) )
        {
            $data = [
                'name' => do_secure( post( 'category' ) ),
                'created_at' => time()
            ];
            
            $id = $this->Support_model->add_faqs_category( $data );
            
            if ( ! empty( $id ) )
            {
                $data['id'] = $id;
                
                $html = read_view( 'admin/responses/add_faqs_category', $data );
                
                r_success_add( $html );
            }
            
            r_error( 'went_wrong' );
        }
        
        d_r_error( form_error( 'category' ) );
    }
    
    /**
     * Edit FAQs Category ( Response ).
     *
     * @return void
     */
    public function edit_faqs_category()
    {
        check_action_authorization( 'faqs' );
        
        if ( ! post( 'id' ) ) r_error( 'invalid_req' );
        
        $data = $this->Support_model->faqs_category( intval( post( 'id' ) ) );
        
        if ( ! empty( $data ) )
        {
            display_view( 'admin/responses/forms/edit_faqs_category', $data );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Update FAQs Category Input Handling.
     *
     * @return void
     */
    public function update_faqs_category()
    {
        check_action_authorization( 'faqs' );
        
        if ( $this->form_validation->run( 'faqs_category' ) )
        {
            $id = intval( post( 'id' ) );
            
            $data = [
                'name' => do_secure( post( 'category' ) )
            ];
            
            if ( $this->Support_model->update_faqs_category( $data, $id ) )
            {
                $data = $this->Support_model->faqs_category( $id );
                $html = read_view( 'admin/responses/update_faqs_category', $data );
                
                r_success_replace( $id, $html );
            }
            
            r_error( 'not_updated' );
        }
        
        d_r_error( form_error( 'category' ) );
    }
    
    /**
     * Delete FAQs Category.
     *
     * @return void
     */
    public function delete_faqs_category()
    {
        check_action_authorization( 'faqs' );
        
        $id = intval( post( 'id' ) );
        
        $has = $this->Support_model->has_faqs( $id );
        
        if ( $has ) r_error( 'delete_faqs' );
        
        if ( $this->Support_model->delete_faqs_category( $id ) )
        {
            r_success_remove( $id );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Add Articles Category Input Handling.
     *
     * @param  string $type
     * @return void
     */
    public function add_articles_category( $type = 'parent' )
    {
       // check_action_authorization( 'knowledge_base' );
        
        if ( $type !== 'parent' && $type !== 'sub' )
        {
            r_error( 'invalid_req' );
            
        }
        
        if ( $this->form_validation->run( 'articles_category' ) )
        {
            $parent = false;
            
            $data = [
                'name' => do_secure( post( 'category' ) ),
                'slug' => do_secure( post( 'slug' ) ),
                'meta_description' => do_secure( post( 'meta_description' ) ),
                'meta_keywords' => do_secure( post( 'meta_keywords' ) ),
                'created_at' => time()
            ];
           
            
            if ( $type === 'sub' )
            {
                $parent = true;
                
                if ( ! post( 'parent_category' ) ) r_error( 'missing_parent_cat' );
                
                $data['parent_id'] = intval( post( 'parent_category' ) );
                
                $result = array_search( $data['parent_id'], array_column( get_articles_categories(), 'id' ) );
                
                if ( $result === false ) r_error( 'invalid_req' );
            }
            
            if ( empty( $data['slug'] ) )
            {
                $data['slug'] = $this->Support_model->articles_category_slug( $data['name'], 0, $parent );
            }
            
            if ( $this->Support_model->articles_category( $data['slug'], 'slug', $parent ) )
            {
                r_error( 'slug_exists' );
            }
            
            $id = $this->Support_model->add_articles_category( $data );
            
            if ( ! empty( $id ) )
            {
                $data['id'] = $id;
                $view = ( $type === 'parent' ) ? 'category' : 'subcategory';
                $html = read_view( 'admin/responses/add_articles_' . $view, $data );
                
                r_success_add( $html );
            }
            
            r_error( 'went_wrong' );
        }
        
        d_r_error( validation_errors() );
    }
    
    /**
     * Edit Articles Category ( Response ).
     *
     * @param  string $type
     * @return void
     */
    public function edit_articles_category( $type = 'parent' )
    {
       // check_action_authorization( 'knowledge_base' );
        
        if ( $type !== 'parent' && $type !== 'sub' ) r_error( 'invalid_req' );
        else if ( ! post( 'id' ) ) r_error( 'invalid_req' );
        
        $data = $this->Support_model->articles_category( intval( post( 'id' ) ) );
        
        if ( ! empty( $data ) )
        {
            $view = ( $type === 'parent' ) ? 'category' : 'subcategory';
            display_view( 'admin/responses/forms/edit_articles_' . $view, $data );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Update Articles Category Input Handling.
     *
     * @param  string $type
     * @return void
     */
    public function update_articles_category( $type = 'parent' )
    {
        //check_action_authorization( 'knowledge_base' );
        
        if ( $type !== 'parent' && $type !== 'sub' )
        {
            r_error( 'invalid_req' );
        }
        
        if ( $this->form_validation->run( 'articles_category' ) )
        {
            $id = intval( post( 'id' ) );
            $category = $this->Support_model->articles_category( $id );
            $parent = false;
            
            $data = [
                'name' => do_secure( post( 'category' ) ),
                'slug' => do_secure( post( 'slug' ) ),
                'meta_description' => do_secure( post( 'meta_description' ) ),
                'meta_keywords' => do_secure( post( 'meta_keywords' ) )
            ];
            
            if ( $type === 'sub' )
            {
                $parent = true;
                
                if ( $category->parent_id == null ) r_error( 'invalid_req' );
                else if ( ! post( 'parent_category' ) ) r_error( 'missing_parent_cat' );
                
                $data['parent_id'] = intval( post( 'parent_category' ) );
                
                $result = array_search( $data['parent_id'], array_column( get_articles_categories(), 'id' ) );
                
                if ( $result === false ) r_error( 'invalid_req' );
            }
            else
            {
                if ( $category->parent_id != null ) r_error( 'invalid_req' );
            }
            
            if ( empty( $data['slug'] ) )
            {
                $data['slug'] = $this->Support_model->articles_category_slug(
                    $data['name'],
                    $id,
                    $parent
                );
            }
            
            if ( $this->Support_model->is_ac_slug_exists( $data['slug'], $id, $parent ) )
            {
                r_error( 'slug_exists' );
            }
            
            if ( $this->Support_model->update_articles_category( $data, $id ) )
            {
                $data = $this->Support_model->articles_category( $id );
                $view = ( $type === 'parent' ) ? 'category' : 'subcategory';
                $html = read_view( 'admin/responses/update_articles_' . $view, $data );
                
                r_success_replace( $id, $html );
            }
            
            r_error( 'not_updated' );
        }
        
        d_r_error( validation_errors() );
    }
    
    /**
     * Delete Articles Category.
     *
     * @return void
     */
    public function delete_articles_category()
    {
        //check_action_authorization( 'knowledge_base' );
        
        $id = intval( post( 'id' ) );
        $data = $this->Support_model->articles_category( $id );
        
        if ( empty( $data ) ) r_error( 'invalid_req' );
        
        if ( $data->parent_id == null )
        {
            $has = $this->Support_model->has_articles_subcategories( $id );
            
            if ( $has ) r_error( 'delete_subcategories' );
        }
        
        $has = $this->Support_model->has_articles( $id );
        
        if ( $has ) r_error( 'delete_articles' );
        
        if ( $this->Support_model->delete_articles_category( $id ) )
        {
            r_success_remove( $id );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Add Article Input Handling.
     *
     * @return void
     */
    public function add_article()
    {
        //check_action_authorization( 'knowledge_base' );
        
        if ( $this->form_validation->run( 'article' ) )
        {
            $data = [
                'title' => do_secure( post( 'title' ) ),
                'slug' => do_secure( post( 'slug' ) ),
                'content' => do_secure( post( 'content' ), true ),
                'meta_keywords' => do_secure( post( 'meta_keywords' ) ),
                'meta_description' => do_secure( post( 'meta_description' ) ),
                'visibility' => only_binary( post( 'visibility' ) ),
                'category_id' => intval( post( 'category' ) ),
                'created_at' => time()
            ];
            
            $result = array_search( $data['category_id'], array_column( get_articles_categories( 'all' ), 'id' ) );
                
            if ( $result === false ) r_error( 'invalid_req' );
            
            if ( empty( $data['slug'] ) )
            {
                $data['slug'] = $this->Support_model->article_slug( $data['title'] );
            }
            
            if ( $this->Support_model->article( $data['slug'], 'slug' ) )
            {
                r_error( 'slug_exists' );
            }
            
            $id = $this->Support_model->add_article( $data );
            
            if ( ! empty( $id ) )
            {
                r_s_jump( 'admin/knowledge_base/articles', 'added' );
            }
            
            r_error( 'went_wrong' );
        }
        
        d_r_error( validation_errors() );
    }
    
    /**
     * Update Article Input Handling.
     *
     * @return void
     */
    public function update_article()
    {
        //check_action_authorization( 'knowledge_base' );
        
        if ( $this->form_validation->run( 'article' ) )
        {
            $id = intval( post( 'id' ) );
            
            $data = [
                'title' => do_secure( post( 'title' ) ),
                'slug' => do_secure( post( 'slug' ) ),
                'content' => do_secure( post( 'content' ), true ),
                'meta_keywords' => do_secure( post( 'meta_keywords' ) ),
                'meta_description' => do_secure( post( 'meta_description' ) ),
                'visibility' => only_binary( post( 'visibility' ) ),
                'category_id' => intval( post( 'category' ) )
            ];
            
            $result = array_search( $data['category_id'], array_column( get_articles_categories( 'all' ), 'id' ) );
                
            if ( $result === false ) r_error( 'invalid_req' );
            
            if ( empty( $data['slug'] ) )
            {
                $data['slug'] = $this->Support_model->article_slug( $data['title'] );
            }
            
            if ( $this->Support_model->is_article_exists_by( $data['slug'], $id ) )
            {
                r_error( 'slug_exists' );
            }
            
            if ( $this->Support_model->update_article( $data, $id ) )
            {
               r_s_jump( "admin/knowledge_base/edit_article/{$id}", 'updated' );
            }
            
            r_error( 'not_updated' );
        }
        
        d_r_error( validation_errors() );
    }
    
    /**
     * Delete Article
     *
     * @return void
     */
    public function delete_article()
    {
        //check_action_authorization( 'knowledge_base' );
        
        $id = intval( post( 'id' ) );
        
        if ( $this->Support_model->delete_article( $id ) )
        {
            $this->Support_model->delete_article_votes( $id );
            
            r_success_remove( $id );
        }
        
        r_error( 'invalid_req' );
    }
    
    /**
     * Get Team Users Data ( For Department ).
     *
     * @return string
     */
    private function get_team_users()
    {
        if ( post( 'users' ) == 1 )
        {
            $ids = [];
            
            if ( empty( post( 'team' ) ) )
            {
                r_error( 'missing_team_users' );
            }
            else if ( ! is_array( post( 'team' ) ) )
            {
                r_error( 'invalid_req' );
            }
            
            foreach ( post( 'team' ) as $user_id )
            {
                $users = get_team_users( 'result_array' );
                $result = array_search( $user_id, array_column( $users, 'id' ) );
                
                if ( $result === false )
                {
                    r_error( 'invalid_req' );
                }
                
                $ids['users'][] = intval( $user_id );
            }
            
            $data = json_encode( $ids );
        }
        else
        {
            $data = 'all_users';
        }
        
        return $data;
    }
    
}