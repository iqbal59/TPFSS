<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Storenew_model extends CI_Model
{
    public function getstores()
    {
        $q = $this->db->query("select * from stores_new");
        return $q->result();
    }

    public function getstate()
    {
        $q = $this->db->query("select * from states where country_id='101'");
        return $q->result();
    }

    public function getcity($state)
    {
        $q = $this->db->query("select * from cities where state_id = $state ORDER BY name ASC");
        return $q->result();
    }
    public function getcityrow($id)
    {
        $q = $this->db->query("select * from cities where state_id = (SELECT store_state FROM stores_new WHERE id = 53) ORDER BY name ASC");
        return $q->result();
    }

    public function add_store($array)
    {
        return $this->db->insert('stores_new', $array);
    }

    public function tblrow($id)
    {
        $sql = "select stores_new.*, states.name as state_name from stores_new left join states on (stores_new.firm_state=states.id) where 1 and stores_new.id =" . $id;
        $q = $this->db->query($sql);
        return $q->row();
    }

    public function viewtblrow($id)
    {
        echo "select * from stores_new left join states on states.id = stores_new.firm_state where stores_new.id=$id";
        $q = $this->db->query("select * from stores_new left join states on states.id = stores_new.firm_state where stores_new.id=$id");
        return $q->row();
    }

    public function edit_store($id, array $post)
    {
        $res = $this->db->where('id', $id)
            ->update('stores_new', $post);
        $this->db->last_query();
        return $res;

    }

    public function status($id, $data)
    {
        return $this->db->where('id', $id)
            ->update('stores_new', $data);

        // return $this->db->query("update stores_new set status=$val, store_crm_code=$str_crm where id=$id");
    }

    public function delete($id)
    {
        $this->db->trans_start();

        $this->db->delete('stores_new', array('id' => $id));

        //$this->db->delete('store_royality', array('store_id' => $id));

        // return $this->db->query("delete from stores_new where id=$id");

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
    public function rlt_row($id)
    {
        $q = $this->db->query("select * from store_royality where store_id=$id");
        return $q->row();
    }
    public function edit_royality($id, $royality)
    {
        // echo '<pre>';			
        // 	print_r($royality);
        // 	echo '</pre>';
        return $this->db->where('store_id', $id)
            ->update('store_royality', $royality);
    }
}

?>