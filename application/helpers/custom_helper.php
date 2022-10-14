<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
    
    //-- check logged user
    if (!function_exists('check_login_user')) {
        function check_login_user()
        {
            $ci = get_instance();
            if ($ci->session->userdata('is_login') != true) {
                $ci->session->sess_destroy();
                redirect(base_url('auth'));
            }
        }
    }


    if (!function_exists('months')) {
        function months($selctedMonth='')
        {
            $months='<select name="month" class="form-control form-control-sm select2">';
            for ($i = 12; $i > 0; $i--) {
                $time = strtotime(sprintf('-%d months', $i));
                $label = date('F', $time);
                $value = date('n', $time);

                $selctedM = $selctedMonth == $value ? 'selected' : '';
                $months.="<option value='$value'  $selctedM >$label</option>";
            }
            $months.="</select>";
            return $months;
        }
    }

    if (!function_exists('check_login_partner')) {
        function check_login_partner()
        {
            $ci = get_instance();
            if ($ci->session->userdata('is_partner_login') != true) {
                $ci->session->sess_destroy();
                redirect(base_url('home/login'));
            }
        }
    }

    if (!function_exists('check_power')) {
        function check_power($type)
        {
            $ci = get_instance();
            
            $ci->load->model('common_model');
            $option = $ci->common_model->check_power($type);
            
            return $option;
        }
    }


//CONVERT NUMBER
if (!function_exists('convert_number')) {
    function convert_number($number)
    {
        if (($number < 0) || ($number > 999999999)) {
            throw new Exception("Number is out of range");
        }
 
        $Gn = floor($number / 100000);  /* Millions (giga) */
        $number -= $Gn * 100000;
        $kn = floor($number / 1000);     /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100);      /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10);       /* Tens (deca) */
        $n = $number % 10;               /* Ones */
 
        $res = "";
 
        if ($Gn) {
            $res .= convert_number($Gn) . " Lacs";
        }
 
        if ($kn) {
            $res .= (empty($res) ? "" : " ") .
convert_number($kn) . " Thousand";
        }
 
        if ($Hn) {
            $res .= (empty($res) ? "" : " ") .
convert_number($Hn) . " Hundred";
        }
 
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen",
"Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty",
"Seventy", "Eighty", "Ninety");
 
        if ($Dn || $n) {
            if (!empty($res)) {
                $res .= " and ";
            }
 
            if ($Dn < 2) {
                $res .= $ones[$Dn * 10 + $n];
            } else {
                $res .= $tens[$Dn];
 
                if ($n) {
                    $res .= " " . $ones[$n];
                }
            }
        }
 
        if (empty($res)) {
            $res = "zero";
        }
 
        return $res;
    }
}
//END CONVERT NUMBER

    //-- current date time function
    if (!function_exists('current_datetime')) {
        function current_datetime()
        {
            $dt = new DateTime('now', new DateTimezone('Asia/Kolkata'));
            $date_time = $dt->format('Y-m-d H:i:s');
            return $date_time;
        }
    }

    //-- show current date & time with custom format
    if (!function_exists('my_date_show_time')) {
        function my_date_show_time($date)
        {
            if ($date != '') {
                $date2 = date_create($date);
                $date_new = date_format($date2, "d M Y h:i A");
                return $date_new;
            } else {
                return '';
            }
        }
    }

    //-- show current date with custom format
    if (!function_exists('my_date_show')) {
        function my_date_show($date)
        {
            if ($date != '') {
                $date2 = date_create($date);
                $date_new = date_format($date2, "d M Y");
                return $date_new;
            } else {
                return '';
            }
        }
    }