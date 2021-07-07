<?php
class Common_model extends CI_Model {

  
  
  /********Sale Data logic*******/
  function saleRefund($from_dt, $to_dt){
    $sql="insert into refundsales(order_date, order_no, store_name, taxable_amount, net_amount, service_code, status, is_bill, customer_id) select order_date, order_no, store_name, taxable_amount, net_amount, service_code, status, is_bill, customer_id from storesales where date(order_date) between '".$from_dt."' and '".$to_dt."' and is_bill=1";
    $query=$this->db->query($sql);
    $query=$this->db->query("delete from storesales where  date(order_date) between '".$from_dt."' and '".$to_dt."'");
    return $query;

}


function refundAdjust($from_dt, $to_dt){

     $sql="select * from (SELECT order_date, order_no, store_name, taxable_amount, net_amount, service_code FROM `refundsales` WHERE 1 and date(order_date) BETWEEN '".$from_dt."' and '".$to_dt."' and is_refund=0
    union all 
    SELECT order_date, order_no, store_name, taxable_amount, net_amount, service_code FROM `storesales` WHERE 1 and date(order_date) BETWEEN '".$from_dt."' and '".$to_dt."' ) as temp
    group by order_no, store_name, taxable_amount, net_amount, service_code HAVING count(*) > 1";
    $query=$this->db->query($sql)->result_array();
    foreach($query as $row)
    {
         $linequery="update storesales set is_bill='1' where order_no='".$row['order_no']."' and store_name='".$row['store_name']."'";
         $this->db->query($linequery);
         $linequery="delete from refundsales where order_no='".$row['order_no']."' and store_name='".$row['store_name']."'";
         $this->db->query($linequery);
    }
}


  /******sale data end logic*********/
  
  /***********GET MID NO */

  function getMidNo($order_no, $mobile_no, $customer_id){
        $sql="SELECT storesales.store_name, stores.paytm_mid1 FROM `storesales` LEFT join stores on (storesales.store_name = stores.store_name) WHERE (order_no='".$order_no."' and mobile_no='".$mobile_no."') or (order_no='".$order_no."' && storesales.customer_id='".$customer_id."') or storesales.customer_id='".$customer_id."'  order by order_date desc limit 0,1";
        $query=$this->db->query($sql)->row_array();
        return $query['paytm_mid1'];
  }
  /***********END MID NO */


  function getStoreId($store_crm_code){
    $sql="SELECT id FROM `stores`  WHERE store_crm_code='".$store_crm_code."'";
    $query=$this->db->query($sql)->row_array();
    return $query['id'];
}

  
    /**************REPORTS***************/

  
  
  
  
  
    function getPaytmData($f_dt, $t_dt){

       
        $query = $this->db->query("SELECT * FROM `paytm` LEFT join stores on(paytm.mid_no=stores.paytm_mid1 or paytm.mid_no=stores.paytm_mid2 or paytm.mid_no=stores.paytm_mid3) where  date(transaction_date) >= '".$f_dt."' and date(transaction_date) <= '".$t_dt."'  order by transaction_date DESC")->result_array();  
        return $query;
    }


    function getBharatPeData($f_dt, $t_dt){
       
        $query = $this->db->query("SELECT * FROM `bharatpe` LEFT join stores on(bharatpe.store_name=stores.bharatpay_id) where  date(transaction_date) >= '".$f_dt."' and date(transaction_date) <= '".$t_dt."' order by transaction_date DESC")->result_array();  
        return $query;
    }

    function getMbData(){
       
        $query = $this->db->query('SELECT  mi.id, mi.amount, mi.invoice_date, mi.invoice_no, s.store_code, mi.material_description FROM material_invoices mi LEFT join stores s on(mi.store_crm_code=s.store_crm_code) order by invoice_date DESC')->result_array();  
        return $query;
    }

    function getSaleOrderData($param){
        $sql='SELECT * FROM storesales LEFT join stores on(storesales.store_name=stores.store_name) where date(order_date) between \''.$param['from_dt'].'\'  and \''.$param['to_dt'].'\' order by order_date DESC';
        $query = $this->db->query($sql)->result_array();  
        return $query;
    }
/**************REPORTS END***************/

    function add_import_sale($param)
    {
          // foreach($params as $key => $value){
              
            $query="insert into storesales (order_date, order_no, store_name, taxable_amount, net_amount, service_code, status, mobile_no, customer_id)values('$param[order_date]', '$param[order_no]', '$param[store_name]', '$param[taxable_amount]', '$param[net_amount]', '$param[service_code]', '$param[status]', '$param[mobile_no]', '$param[customer_id]') on duplicate key update 
            taxable_amount='".$param['taxable_amount']."', net_amount='".$param['net_amount']."', service_code='".$param['service_code']."', status='".$param['status']."', customer_id='".$param['customer_id']."'";
            $this->db->query($query);    
       // }
       
    }
    
    
    function matchPaytmWithBank()
        {
            $query="select paytmdata.amount, utr_no, (commission + gst) as fc, (paytmdata.amount-commission-gst) as ba, bank_paytm.amount as bta  from (SELECT sum(paytm.amount) as amount, utr_no, sum(commission) as commission, sum(gst) as gst  FROM `paytm` WHERE 1 and paytm.is_reconcile=0 group by utr_no) as paytmdata left join bank_paytm on (bank_paytm.ref_no=paytmdata.utr_no)";

            return $this->db->query($query)->result_array();

        }
    
     function paytmReconcile($utr_no){
                $query="update paytm set is_reconcile=1 where utr_no='$utr_no'";
                $this->db->query($query);
     }   


     function matchBharatpeithBank()
        {
           

            return $this->db->get('bharatpewithbank')->result_array();

        }
    
     function bharatpeReconcile($utr_no){
                $query="update bharatpe set is_reconcile=1 where utr_no='$utr_no'";
                $this->db->query($query);
     }   

     function bharatpebill($ids){
        $query="update bharatpe set is_bill=1 where id in($ids)";
        $this->db->query($query);
}   
    
function paytmbill($ids){
    $query="update paytm set is_bill=1 where id in($ids)";
    $this->db->query($query);
}   


    
    function get_all_count_by_table($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }
      
    function get_all_by_table($table, $params = array())
    {
        $this->db->order_by('id', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get($table)->result_array();
    }
     
    
    function get_material_by_id($id)
    {
        return $this->db->get_where('material_invoices',array('id'=>$id))->row_array();
    }


    function update_material($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('material_invoices',$params);
    }



//-- insert function
public function insert_ignore($data,$table){
        
    $insert_query = $this->db->insert_string($table, $data);
    $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
    $this->db->query($insert_query);       
    return $this->db->insert_id();
}


    //-- insert function
	public function insert($data,$table){

        $this->db->insert($table,$data);        
        return $this->db->insert_id();
    }

    //-- edit function
    function edit_option($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    } 

    //-- update function
    function update($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    } 

    function updateStoreOpenBalance($store_id, $open_bal){
         $query="update stores set opening_balance=$open_bal where store_crm_code='".$store_id."'";
         $this->db->query($query);
    } 


    //-- delete function
    function delete($id,$table){
        $this->db->delete($table, array('id' => $id));
        return;
    }

    //-- user role delete function
    function delete_user_role($id,$table){
        $this->db->delete($table, array('user_id' => $id));
        return;
    }


    //-- select function
    function select($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- select by id
    function select_option($id,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 

    //-- check user role power
    function check_power($type){
        $this->db->select('ur.*');
        $this->db->from('user_role ur');
        $this->db->where('ur.user_id', $this->session->userdata('id'));
        $this->db->where('ur.action', $type);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    public function check_email($email){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }

    public function check_exist_power($id){
        $this->db->select('*');
        $this->db->from('user_power');
        $this->db->where('power_id', $id); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }


    //-- get all power
    function get_all_power($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('power_id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- get logged user info
    function get_user_info(){
        $this->db->select('u.*');
        $this->db->select('c.name as country_name');
        $this->db->from('user u');
        $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->where('u.id',$this->session->userdata('id'));
        $this->db->order_by('u.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- get single user info
    function get_single_user_info($id){
        $this->db->select('u.*');
        $this->db->select('c.name as country_name');
        $this->db->from('user u');
        $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->where('u.id',$id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    //-- get single user info
    function get_user_role($id){
        $this->db->select('ur.*');
        $this->db->from('user_role ur');
        $this->db->where('ur.user_id',$id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


    //-- get all users with type 2
    function get_all_user(){
        $this->db->select('u.*');
        $this->db->select('c.name as country, c.id as country_id');
        $this->db->from('user u');
        $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->order_by('u.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


    //-- count active, inactive and total user
    function get_user_total(){
        $this->db->select('*');
        $this->db->select('count(*) as total');
        $this->db->select('(SELECT count(user.id)
                            FROM user 
                            WHERE (user.status = 1)
                            )
                            AS active_user',TRUE);

        $this->db->select('(SELECT count(user.id)
                            FROM user 
                            WHERE (user.status = 0)
                            )
                            AS inactive_user',TRUE);

        $this->db->select('(SELECT count(user.id)
                            FROM user 
                            WHERE (user.role = "admin")
                            )
                            AS admin',TRUE);

        $this->db->from('user');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //-- image upload function with resize option
    function upload_image($max_size){
            
            //-- set upload path
            $config['upload_path']  = "./assets/images/";
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['max_size']     = '92000';
            $config['max_width']    = '92000';
            $config['max_height']   = '92000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("photo")) {

                
                $data = $this->upload->data();

                //-- set upload path
                $source             = "./assets/images/".$data['file_name'] ;
                $destination_thumb  = "./assets/images/thumbnail/" ;
                $destination_medium = "./assets/images/medium/" ;
                $main_img = $data['file_name'];
                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_medium   = $max_size ;
                $limit_thumb    = 200 ;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
                    $percent_medium = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = ' 100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                ////// Making MEDIUM /////////////
                $img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $mid = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                //-- set upload path
                $images = 'assets/images/medium/'.$mid;
                $thumb  = 'assets/images/thumbnail/'.$thumb_nail;
                unlink($source) ;

                return array(
                    'images' => $images,
                    'thumb' => $thumb
                );
            }
            else {
                echo "Failed! to upload image" ;
            }
            
    }

}