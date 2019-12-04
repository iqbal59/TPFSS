<?php

class Service_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get service by id
     */
    function get_service($id)
    {
        return $this->db->get_where('services',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all services
     */
    function get_all_services()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('services')->result_array();
    }
        
    /*
     * function to add new service
     */
    function add_service($params)
    {
        $this->db->insert('services',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update service
     */
    function update_service($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('services',$params);
    }
    
    /*
     * function to delete service
     */
    function delete_service($id)
    {
        return $this->db->delete('services',array('id'=>$id));
    }
}