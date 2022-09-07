<?php
class Api_model extends CI_Model
{
    public function get_all_invoice()
    {
        $this->db->select("invoices.id, net_amount, store_name, invoice_date, firm_name, store_state, concat('TD/','22-23','/', invoices.invoice_no) as invoice_no");
        $this->db->from("invoices");
        $this->db->join("stores", "stores.id=invoices.store_id", "left");
        $this->db->where('is_sync', 0);
        //$this->db->where('date(invoices.invoice_date) <=', $to_dt);
        return $this->db->get()->result_array();
    }


    public function sync_with_tally($invoiceId)
    {
        $this->db->where('id', $invoiceId);
        $this->db->update('invoices', array('is_sync'=>1));
        return;
    }
}