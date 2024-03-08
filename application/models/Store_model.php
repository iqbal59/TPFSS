<?php


class Store_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * Get store by id
     */
    public function get_store($id)
    {
        return $this->db->get_where('stores', array('id' => $id))->row_array();
    }


    /*
     * Get store by code
     */
    public function get_store_by_code($id)
    {
        return $this->db->get_where('stores', array('store_crm_code' => $id))->row_array();
    }

    public function get_store_by_firm_name($id)
    {
        return $this->db->get_where('stores', array('firm_name' => $id))->row_array();
    }



    public function get_store_by_email_id($store_code, $email_id)
    {
        return $this->db->get_where('stores', array('store_crm_code' => $store_code, 'email_id' => $email_id))->row_array();
    }


    /*
     * Get all stores count
     */
    public function get_all_stores_count()
    {
        $this->db->from('stores');
        return $this->db->count_all_results();
    }


    /*
     * Get all royalties
     */
    public function get_store_all_royalties($id)
    {
        $query = "SELECT name, code, royality, ifnull(store_royalty, royality) as store_royalty, services.id FROM services left join (SELECT * from royalties WHERE royalties.store_id='$id') as temp on (services.id=temp.service_id)";
        return $this->db->query($query)->result_array();
    }



    /*
     * Get all stores
     */
    public function get_all_stores($params = array())
    {
        $this->db->order_by('id', 'desc');
        // if(isset($params) && !empty($params))
        // {
        //     $this->db->limit($params['limit'], $params['offset']);
        // }
        return $this->db->get('stores')->result_array();
    }



    public function get_all_amc_store()
    {


        $sql = "SELECT * FROM `stores` where 1 and is_active=1   and store_type = 1 and ((launch_date >='2022-07-01' and curdate() >= (launch_date + INTERVAL 365 day) and (is_amc= 0 or is_amc=1)) or is_amc=1)";
        return $this->db->query($sql)->result_array();
    }


    public function get_all_store_have_to_renewal()
    {

        //We are assuming it will call on every thursday

        $sql = "SELECT * FROM `stores` where 1 and is_active=1 and licence_renewal_date is not null and licence_renewal_date between curdate()+ interval 8 day and curdate() + interval 14 day ";
        return $this->db->query($sql)->result_array();
    }



    public function get_all_store_without_license()
    {

        //We are assuming it will call on every thursday

        $sql = "SELECT * FROM `stores` where 1 and is_active=1 and licence_renewal_date is null";
        return $this->db->query($sql)->result_array();
    }


    public function get_all_amc_store_count()
    {
        // $sql = "SELECT * FROM `stores` where 1 and is_active=1   and store_type = 1 and launch_date >='2022-07-01' and curdate() > launch_date + INTERVAL 365 day";
        //return $this->db->query($sql)->count_all_results();
    }

    public function get_all_active_stores()
    {
        $this->db->order_by('id', 'desc');
        // if(isset($params) && !empty($params))
        // {
        //     $this->db->limit($params['limit'], $params['offset']);
        // }
        $this->db->where('is_active', 1);
        return $this->db->get('stores')->result_array();
    }

    public function get_all_active_stores_with_balance()
    {
        $yourTime = time();
        $day = date('w', $yourTime);
        $time = $yourTime - ($day >= 4 ? ($day + 7 - 4) : ($day + 14 - 4)) * 3600 * 24;
        $myDate = date('Y-m-d', $time);
        // $sql = "select *,  get_open_balance('" . $myDate . "', stores.id) as open_bal , get_payment('" . $myDate . "', stores.id) as payment from stores where is_active=1";

        $sql = "select * from stores where is_active=1";
        return $this->db->query($sql)->result_array();
    }



    /*
     * function to add new store
     */
    public function add_store($params)
    {
        $this->db->insert('stores', $params);
        return $this->db->insert_id();
    }

    public function add_update_store($params)
    {

        $this->db->where('store_crm_code', $params['store_crm_code']);
        $q = $this->db->get('stores');

        if ($q->num_rows() > 0) {
            $this->db->where('store_crm_code', $params['store_crm_code']);
            return $this->db->update('stores', $params);
        } else {
            $this->db->set('store_crm_code', $params['store_crm_code']);
            return $this->db->insert('stores', $params);
        }

    }

    public function add_store_new($params)
    {
        $this->db->insert('stores_new', $params);
        return $this->db->insert_id();
    }

    /*
     * function to update store
     */
    public function update_store($id, $params)
    {
        $this->db->where('id', $id);
        return $this->db->update('stores', $params);
    }


    public function change_password($id, $params, $old_password)
    {
        $this->db->where('id', $id);
        $this->db->where('password', md5($old_password));
        $this->db->update('stores', $params);
        return $this->db->affected_rows();
    }


    public function forget_password($id, $params)
    {
        $this->db->where('id', $id);
        return $this->db->update('stores', $params);
    }


    /*
     * function to update store
     */
    public function update_store_royality($id, $params)
    {
        foreach ($params['store_royalty'] as $store_royality) {
            foreach ($store_royality as $key => $royalty) {
                if ($params['royality'][$id][$key] == $royalty) {
                    continue;
                }
                echo $query = "insert into royalties (service_id, store_id, store_royalty)values('$key', '$id', '$royalty') on duplicate key update store_royalty='$royalty'";
                $this->db->query($query);
            }
        }
    }



    /*
     * function to delete store
     */
    public function delete_store($id)
    {
        return $this->db->delete('stores', array('id' => $id));
    }
}