<?php
class Accounts_model extends CI_Model {

function get_all_sale_by_store($date)
    {
      
        $query=$this->db->query('CALL get_sale_by_store(?)',array('dt'=>$date));
        $res=$query->result_array();
        mysqli_next_result($this->db->conn_id);

        $query->free_result();
        return $res;
    }

    function calculate_balance_by_date($date){
           return $this->db->query("select *, (msales+rsales+debit-receipt-credit) as openbalance from (select stores.id, stores.store_crm_code, stores.store_name, ifnull(msales, 0) as msales, ifnull(rsales, 0) as rsales, ifnull(receipt, 0) as receipt, ifnull(debit, 0) as debit, ifnull(credit, 0) as credit from stores left join (SELECT store_crm_code, sum(amount) as msales FROM `material_invoices` where invoice_date <= '$date'  group by store_crm_code) as mtable on (stores.store_crm_code=mtable.store_crm_code) left join (select sum(net_amount) as rsales, store_id from invoices where date(invoice_date) <= 'date' group by store_id) rtable on (rtable.store_id=stores.id) left join (SELECT store_id, sum(case when voucher_type = 'R' then amount else 0 end) as receipt, sum(case when voucher_type = 'D' then amount else 0 end) as debit, sum(case when voucher_type = 'C' then amount else 0 end) as credit FROM `vouchers` WHERE 1 and date(create_date) <= 'date'  group by store_id
            ) as v on (v.store_id=stores.id)) as openbalancetable")->result_array();

    }

    function calculate_balance_by_store($date, $id){
        return $this->db->query("select *, (msales+rsales+debit-receipt-credit) as openbalance from (select stores.id, stores.store_crm_code, stores.store_name, ifnull(msales, 0) as msales, ifnull(rsales, 0) as rsales, ifnull(receipt, 0) as receipt, ifnull(debit, 0) as debit, ifnull(credit, 0) as credit from stores left join (SELECT store_crm_code, sum(amount) as msales FROM `material_invoices` where invoice_date <= '$date'  group by store_crm_code) as mtable on (stores.store_crm_code=mtable.store_crm_code) left join (select sum(net_amount) as rsales, store_id from invoices where date(invoice_date) <= 'date' group by store_id) rtable on (rtable.store_id=stores.id) left join (SELECT store_id, sum(case when voucher_type = 'R' then amount else 0 end) as receipt, sum(case when voucher_type = 'D' then amount else 0 end) as debit, sum(case when voucher_type = 'C' then amount else 0 end) as credit FROM `vouchers` WHERE 1 and date(create_date) <= 'date'  group by store_id
         ) as v on (v.store_id=stores.id)) as openbalancetable where id=$id")->row_array();

    }

  function get_bharatpe_by_store($date)
  {
      return $this->db->query("SELECT sum(amount) as amount, bharatpe.store_name, group_concat(bharatpe.id) as ids, stores.id as store_id FROM `bharatpe` left join stores on (stores.bharatpay_id=bharatpe.store_name) WHERE is_reconcile=1 and date(transaction_date) <= '$date' and stores.id != null and is_bill=0 group by store_name")->result_array();
  }



  function get_paytm_by_store($date)
  {
      return $this->db->query("select mid_no, (amount-commission-gst) as final_amount, (commission+gst) as  paytmcommission, stores.id as store_id, ids  from (SELECT  mid_no, sum(amount) as amount, sum(commission) as commission, sum(gst) as gst, group_concat(paytm.id) as ids FROM `paytm` where is_reconcile=1 and is_bill=0 AND date(transaction_date) <= '$date' GROUP by mid_no) as temptable left join stores on (stores.paytm_mid1=mid_no) where stores.id != null")->result_array();
  }


    function ledgerItem($date, $sotreid)
        {
            return $this->db->query("SELECT id, net_amount as np, 'Sale' as voucher_type, date(invoice_date) as voucher_date FROM `invoices` where 1 and date(invoice_date) >= '$date' and store_id=$sotreid

            UNION
            
            SELECT material_invoices.id, material_invoices.amount as np ,'Sale' as voucher_type, material_invoices.invoice_date as voucher_date from material_invoices LEFT join stores on (stores.store_crm_code=material_invoices.store_crm_code)  WHERE 1 and material_invoices.invoice_date >= '$date' and stores.id=$sotreid
            
            
            UNION
            
            SELECT vouchers.id, vouchers.amount as np, vouchers.voucher_type  , date(vouchers.create_date) as voucher_date from vouchers WHERE 1 and date(vouchers.create_date) >= '$date' and vouchers.store_id=$sotreid")->result_array();
        }

    function get_all_invoice(){
        $this->db->select("invoices.id, net_amount, store_name, invoice_date");
        $this->db->from("invoices");
        $this->db->join("stores", "stores.id=invoices.store_id", "left");
       return $this->db->get()->result_array();

    }

        function saveInvoice($data)
        {
            foreach ($data as $store_id=>$items)
            {
                $total_amount=0;
                $tax_amount=0;
                $net_amount=0;
                $this->db->insert('invoices', array('store_id'=>$store_id));
                $invoice_id=$this->db->insert_id();
                $storeData=$this->db->get_where('stores',array('id'=>$store_id))->row_array();
                foreach($items as $item){

                    //print_r($item);
                    $this->db->insert('invoice_item', array('invoice_id'=>$invoice_id, 'item_name'=>$item['item_name'], 'rate'=>$item['rate'], 'order_nos'=>$item['order_ids'])); 

                    $total_amount+=$item['rate'];
                    $this->db->query("update storesales set is_bill=1 where store_name='$storeData[store_name]' and order_no in($item[order_ids])");
                }
                    $tax_amount=$total_amount*18/100;
                    $net_amount=$total_amount+$tax_amount;
                    $this->db->query("update invoices set amount='$total_amount', tax_rate='18', tax_amount='$tax_amount', net_amount='$net_amount' where id='$invoice_id'");
            }
            
        }

}
?>