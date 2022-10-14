<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */
 
class Voucher_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table          = 'voucher_view';
        $fields               = $this->db->list_fields($this->table);
        $this->column_order   = $this->getColumnOrder($fields);
        $this->column_search  = $this->getColumnSearch($fields);
    }
    
    /*
     * Get voucher by id
     */
    public function get_voucher($id)
    {
        return $this->db->get_where('vouchers', array('id'=>$id))->row_array();
    }
    
    /*
     * Get all vouchers count
     */
    public function get_all_vouchers_count()
    {
        $this->db->from('vouchers');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all vouchers
     */
    public function get_all_vouchers($params = array())
    {
        $this->db->select('vouchers.*, stores.store_name, stores.store_crm_code');
        
        $this->db->join('stores', 'stores.id=vouchers.store_id', 'left');
        $this->db->where('date(vouchers.create_date) >=', $params['from_dt']);
        $this->db->where('date(vouchers.create_date) <=', $params['to_dt']);
        $this->db->order_by('id', 'desc');
        // if(isset($params) && !empty($params))
        // {
        //     $this->db->limit($params['limit'], $params['offset']);
        // }
        
        return $this->db->get('vouchers')->result_array();
    }
        
    /*
     * function to add new voucher
     */
    public function add_voucher($params)
    {
        $this->db->insert('vouchers', $params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update voucher
     */
    public function update_voucher($id, $params)
    {
        $this->db->where('id', $id);
        return $this->db->update('vouchers', $params);
    }
    
    /*
     * function to delete voucher
     */
    public function delete_voucher($id)
    {
        return $this->db->delete('vouchers', array('id'=>$id));
    }




    public function getColumnOrder($fields)
    {
        $list 		= [];
        $list[0] 	= null;
        foreach ($fields as $field) {
            $list[] = $field;
        }
        return $list;
    }

    public function getColumnSearch($fields)
    {
        $list 		= [];
        foreach ($fields as $field) {
            $list[] = $field;
        }
        return $list;
    }

    public function getRows($postData)
    {
        $this->_get_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function countAll($postData)
    {
        $this->db->from($this->table);
        $this->db->where(["create_date >="=>$postData['from_date']]);
        $this->db->where(["create_date <="=>$postData['to_date']]);
        return $this->db->count_all_results();
    }
    
    public function countFiltered($postData)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData)
    {
        $this->db->from($this->table);
       
        // if($this->is_admin) {
        // 	$this->db->where(["status"=>$postData['status']]);
        // } else {
        // 	$this->db->where(["status"=>$postData['status'], "created_by"=>$this->login_id]);
        // }
        $this->db->where(["create_date >="=>$postData['from_date']]);
        $this->db->where(["create_date <="=>$postData['to_date']]);
        //  $this->db->order_by('create_date', 'DESC');
 
        $i = 0;
        // loop searchable columns
        foreach ($this->column_search as $item) {
            // if datatable send POST for search
            if ($postData['search']['value']) {
                // first loop
                if ($i===0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }
                // last loop
                if (count($this->column_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if (isset($postData['order'])) {
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}