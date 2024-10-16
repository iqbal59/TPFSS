<?php
class Api_model extends CI_Model
{
    public function get_all_invoice()
    {
        $this->db->select("invoices.id, net_amount, store_name, invoice_date, firm_name, store_state, case when invoice_type = 0 then concat('TD/','24-25','/', invoices.invoice_no) when  invoice_type= 2 then concat('CRM/','24-25','/', invoices.invoice_no) else concat('AMC/','24-25','/', invoices.invoice_no) end as invoice_no, store_address, store_city, store_state, gstin_no, email_id, pan_no, contact_number, amount, tax_amount, tax_rate, gst_st_code, 	descriptions,pin_code, invoice_type");
        $this->db->from("invoices");
        $this->db->join("stores", "stores.id=invoices.store_id", "left");
        $this->db->where('is_sync', 0);
        //$this->db->where('date(invoices.invoice_date) <=', $to_dt);
        $this->db->limit(300, 0);
        return $this->db->get()->result();
    }



    public function get_all_creditnote()
    {
        $this->db->select("vouchers.id, amount as net_amount, store_name, create_date as invoice_date, firm_name, store_state, concat('UP/CN/R/0', vouchers.serial_no) as invoice_no, store_address, store_city, store_state, gstin_no, email_id, pan_no, contact_number, amount, round((amount*100)/118,2) as taxable_amount, round(((amount*100)/118)*0.18,2) as tax_amount, 18 as tax_rate, gst_st_code, descriptions,pin_code");
        $this->db->from("vouchers");
        $this->db->join("stores", "stores.id=vouchers.store_id", "left");
        $this->db->where('is_sync', 0);
        $this->db->where('descriptions not like', 'Paytm%');
        $this->db->where('voucher_type', 'C');
        $this->db->where('date(vouchers.create_date) >=', '2023-07-13');
        $this->db->limit(300, 0);
        return $this->db->get()->result();
    }

    public function get_all_payment()
    {
        $this->db->select("vouchers.id, amount as net_amount, store_name, create_date as voucher_date, firm_name, store_state, concat('TD/','24-25','/', vouchers.id) as voucher_no, store_address, store_city, store_state, gstin_no, email_id, pan_no, contact_number, amount, 12 as tax_amount, 18 as tax_rate, gst_st_code, descriptions,pin_code, voucher_type");
        $this->db->from("vouchers");
        $this->db->join("stores", "stores.id=vouchers.store_id", "left");
        $this->db->where('is_sync', 0);
        $this->db->where('voucher_type', 'R');
        $this->db->where('date(vouchers.create_date) >=', '2023-07-13');
        $where = ' (is_sync=0 and voucher_type = \'C\' and descriptions like \'Paytm %\' )';
        $this->db->or_where($where);
        $this->db->limit(300, 0);
        return $this->db->get()->result();
    }



    public function get_all_customers()
    {
        $this->db->select("store_crm_code, store_code, store_name, firm_name,email_id,contact_number,gstin_no, store_address");
        $this->db->from("stores");
        return $this->db->get()->result();
    }


    public function get_fss_status($id)
    {
        $yourTime = time();
        $day = date('w', $yourTime);
        $time = $yourTime - ($day >= 4 ? ($day + 7 - 4) : ($day + 14 - 4)) * 3600 * 24;
        $myDate = date('Y-m-d', $time);
        $sql = "select *,  get_open_balance('" . $myDate . "', stores.id) as open_bal , get_payment('" . $myDate . "', stores.id) as payment from stores where is_active=1 and id=" . $id;


        return $this->db->query($sql)->result_array();
    }

    public function sync_with_tally($invoiceId)
    {
        $this->db->where('id', $invoiceId);
        return $this->db->update('invoices', array('is_sync' => 1));
    }
    public function sync_with_tally_credit_note_or_payment($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('vouchers', array('is_sync' => 1));
    }


    public function get_mis_usermap()
    {
        return $this->db->select('u1.id, u1.email, u1.name, u1.role, u2.name as zsm_name')
            ->from('tbl_mis_user u1')
            ->join('tbl_mis_user u2', "u1.parent_id=u2.id")
            ->get()->result();

    }


    public function get_target()
    {
        return $this->db->select('*')
            ->from('tbl_revenue_target u1')

            ->get()->result();

    }

    public function get_mis_role($email_id)
    {
        $sql = "
SELECT DISTINCT
       zsm_email AS email,
    'ZSM' AS role

FROM tbl_revenue_target
WHERE LOWER(zsm_email) = LOWER('" . $email_id . "')
UNION
        SELECT  DISTINCT
  tsm_email AS email,
    'TSM' AS role
    
FROM tbl_revenue_target
WHERE LOWER(tsm_email) = LOWER('" . $email_id . "')";




        return $this->db->query($sql)->row();

    }

    public function get_sales_summary($date, $type)
    {
        if ($type == 'store')
            $query = $this->db->query('CALL GetSalesSummary(?)', array('input_current_date' => $date));
        if ($type == 'tsm')
            $query = $this->db->query('CALL GetSalesSummaryTsmWise(?)', array('input_current_date' => $date));
        if ($type == 'zsm')
            $query = $this->db->query('CALL GetSalesSummaryZsmWise(?)', array('input_current_date' => $date));
        if ($type == 'all')
            $query = $this->db->query('CALL GetAllSalesRevenue(?)', array('input_current_date' => $date));
        $res = $query->result_array();
        //print_r($res);
        mysqli_next_result($this->db->conn_id);

        $query->free_result();
        return $res;
    }


    public function get_package_summary($date, $type)
    {
        if ($type == 'store')
            $query = $this->db->query('CALL GetPackageSummary(?)', array('input_current_date' => $date));
        if ($type == 'tsm')
            $query = $this->db->query('CALL GetPackageSummary(?)', array('input_current_date' => $date));
        if ($type == 'zsm')
            $query = $this->db->query('CALL GetPackageSummary(?)', array('input_current_date' => $date));
        if ($type == 'all')
            $query = $this->db->query('CALL GetPackageSummary(?)', array('input_current_date' => $date));
        $res = $query->result_array();
        //print_r($res);
        mysqli_next_result($this->db->conn_id);

        $query->free_result();
        return $res;
    }

}