<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Washing_model extends MY_Model {
    
    public function getModel($table_name , $order_column='', $order_by='')
    {
        $this->db->from($table_name);
        $this->db->order_by($order_column, $order_by);
        return $this->db->get()->result();
        
       // return $this->get( $data );
    }

    public function getFabricList($garment_id){
        $sql="select * from tbl_fabrics where 1 and find_in_set($garment_id, garment_ids) order by name asc";
        return $this->db->query($sql)->result();

    }

    public function getListEmbellishmentByGarmentId($garment_id){
        $sql="select DISTINCT(embellishment_id) as embellishment_id from articles_washing where 1 and find_in_set($garment_id, garment_id)";
        return $this->db->query($sql)->result();

    }

    public function getColorsListByGarmentId($garment_id){
        $sql="select DISTINCT(articles_washing.color_id) as color_id from articles_washing where 1 and find_in_set($garment_id, garment_id)";
        return $this->db->query($sql)->result();

    }

    public function washing_article_slug( $name, $id = 0 )
    {
        return $this->generate_slug( 'articles_washing', $name, $id );
    }
    



    public function washing($value, $column = 'id' )
    {
        $data['table'] = 'articles_washing';
        $data['where'][$column] = $value;
        
        return $this->get_one( $data );
    }
    

    public function add_washing( $data )
    {
        return $this->add( $data, 'articles_washing' );
    }

    public function update_washing( $to_update, $id )
    {
       $data['column_value'] = $id;
       $data['table'] = 'articles_washing';
       $data['data'] = $to_update;
       
       return $this->update( $data );
    }
    

    public function articles( $count = false, $limit = 0, $offset = 0, $options = [] )
    {
        $data['table'] = 'article_washing_view';
        $data['limit'] = $limit;
        $data['offset'] = $offset;
        
        if ( ! empty( $options['searched'] ) )
        {
            $holders = ['id', 'title'];
            
            foreach ( $holders as $holder )
            {
                $data['like'][$holder] = $options['searched'];
            }
        }
        
        if ( ! empty( $options['visibility'] ) )
        {
            $visibility = $options['visibility'];
            
            if ( in_array( $visibility, ['public', 'hidden'] ) )
            {
                $visibility = ( $visibility === 'public' ) ? 1 : 0;
                
                $data['where']['visibility'] = $visibility;
            }
        }
        
        if ( $count === true )
        {
            return $this->get_count( $data );
        }
        
        return $this->get( $data );
    }

    public function article( $value, $column = 'id' )
    {
        $data['table'] = 'articles_washing';
        $data['where'][$column] = $value;
        
        return $this->get_one( $data );
    }
    

    public function articleMachine( $value, $column = 'id' )
    {
        $data['table'] = 'article_washing_machine';
        $data['where'][$column] = $value;
        
        return $this->get( $data );
    }
    
    public function delete_washing( $id )
    {
        $data['column_value'] = $id;
        $data['table'] = 'articles_washing';
        
        return $this->delete( $data );
    }
    
    

    public function delete_article_wahsing_chemical( $id )
    {
        $data['where']['washing_article_id'] = $id;
        $data['table'] = 'article_washing_chemicals';
        
        $this->delete( $data );
    }


    public function delete_article_wahsing_machine( $id )
    {
        $data['where']['washing_article_id'] = $id;
        $data['table'] = 'article_washing_machine';
        
        $this->delete( $data );
    }



    public function get_article_wahsing_chemical( $id )
    {
         $sql="select * from tbl_chemicals where 1 and id in ($id)";
        return $this->db->query($sql)->result();
    }






    public function getDataById($condition, $tableName){
        $sql="select * from ".$tableName." where 1 and ".$condition;
        return $this->db->query($sql)->result();
       
    }

    public function getAllChemicals($condition=""){
        $sql="select id, concat(dosing_type, '-', chemical_name,'-', dosage, '-', wash_load, '-', total_dose) as chemical_name from tbl_chemicals where 1 ".$condition;
        return $this->db->query($sql)->result();
       
    }

    public function getPublicWashingArticle($garment,  $fabric, $embellishment='', $color='', $machine_id=''){
         $sql="SELECT aw.* FROM `articles_washing` aw join article_washing_machine awm on (aw.id=awm.washing_article_id) where 1 and FIND_IN_SET($garment, garment_id) and FIND_IN_SET($fabric, fabric_id) and FIND_IN_SET($color, color_id) and embellishment_id=".$embellishment ." and machine_id='".$machine_id."'";
        return $this->db->query($sql)->row();
       
    }

    public function getPublicWashingProgram($machine_id,  $washing_article_id){
        
           $sql="SELECT wash_program_id, wp.wash_program_name, dp.dry_program_name, dp.dry_time, dry_program_id, wash_chemical_ids FROM `article_washing_machine` awm join tbl_wash_program wp on (awm.wash_program_id=wp.id) join tbl_drying_program dp on (awm.dry_program_id=dp.id)  where awm.machine_id= '".$machine_id."' and washing_article_id='".$washing_article_id."'";
         
          return $this->db->query($sql)->row();
         
      }

    
    

}