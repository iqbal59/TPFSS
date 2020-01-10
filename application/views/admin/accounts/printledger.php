
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
<head>
<title>Dioptres Unlimited</title>
<link rel="stylesheet" type="text/css" href="view/stylesheet/stylesheet.css" />
<style type="text/css">
html {
	margin: 0;
	padding: 0;
	height: 100%;
}
body {
	margin: 0;
	padding: 0;
	height: 100%;
	background: #FFFFFF;
}
body, td, th, input, select, textarea, option, optgroup {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
}
input[type='text'] {
	padding: 2px;
}
select {
	padding: 1px;
}
textarea {
	padding: 2px;
}
a, a:visited {
	color: #003366;
	cursor: pointer;
	text-decoration:none;
}
form {
	margin: 0;
	padding: 0;
}
#header {
	height: 56px;
	padding: 0px 30px;
	background: url('../image/header.png') repeat-x;
	min-width: 900px;
}
#header .div1 {
	color: #FFFFFF;
	padding: 18px 0px 0px 0px;
	float: left;
}
#header .div2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFF;
	text-align: right;
	padding: 14px 0px 0px 0px;
	float: right;
}
#header .div2 span {
	font-weight: bold;
}
#menu {
	background: url('../image/menu.png') repeat-x;
	position: relative;
	z-index: 1;
	height: 34px;
	clear: both;
	padding: 0px 30px;
	min-width: 900px;
}
ul.left {
	float: left;
}
ul.right {
	float: right;
}
.nav {
	position: relative;
	margin: 0;
	padding: 0;
}
.nav ul {
	list-style: none;
	margin: 0;
	padding: 0;
	background: url('../image/transparent.png');
}
.nav a {
	display: block;
	color: #FFFFFF;
	text-decoration: none;
	padding: 5px;
}
.nav > li + li {
	background: url('../image/split.png') center left no-repeat;
}
.nav .top, .nav li li.sfhover {
	padding: 10px 15px 9px 17px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
	text-align: center;
}
.nav ul li {
	padding: 2px;
}
.nav .selected .top {
	background: url('../image/selected.png') repeat-x;
	color: #FFFFFF;
}
.nav .selected:hover a.top, .nav .sfhover a.top {
}
.nav .parent {
	background: url('../image/arrow_right.png') 95% center no-repeat;
}
.nav li {
	float: left;
	list-style: none;
}
.nav li ul {
	position: absolute;
}
.nav li li {
	clear: both;
}
.nav li ul a {
	color: #FFFFFF;
	height: 15px;
	width: 145px;
}
.nav li ul ul {
	margin: -27px 0 0 157px;
}
.nav li li:hover, .nav li li.sfhover {
	background: #333;
	color: #000000;
}
#content {
	background: #FFFFFF url('../image/background.png') 0px 1px repeat-x;
	padding: 10px 30px 0px 30px;
	min-width: 900px;
	padding-bottom: 128px;
}
#container {
	height: 100%;
}
body > #container {
	height: auto;
	min-height: 100%;
}
#footer {
	background: #FFFFFF url('../image/footer.png') repeat-x;
	height: 90px;
	padding-top: 38px;
	text-align: center;
	font-size: 12px;
	color: #333;
	position: relative;
	margin-top: -128px;
	clear: both;
}
#footer a {
	color: #333;
	text-decoration: underline;
}
.breadcrumb, .breadcrumb a {
	font-size: 12px;
	color: #666;
	margin-bottom: 15px;
}
.success {
	padding: 15px 0px;
	margin-bottom: 15px;
	background: #E4F1C9;
	border: 1px solid #A5BD71;
	font-size: 12px;
	text-align: center;
}
.warning {
	padding: 15px 0px;
	margin-bottom: 15px;
	background: #FFDFE0;
	border: 1px solid #FF9999;
	font-size: 12px;
	text-align: center;
}
.attention {
	padding: 15px 0px;
	margin-bottom: 15px;
	background: #FEFBCC;
	border: 1px solid #E6DB55;
	font-size: 12px;
	text-align: center;
}
.box {
	margin-bottom: 15px;
}
.box > .heading {
	height: 40px;
	background: url('../image/box_center.png') repeat-x;
	margin-bottom: 0px;
}
.box > .left {
	float: left;
	width: 7px;
	height: 40px;
	background: url('../image/box_left.png') no-repeat;
}
.box > .right {
	float: right;
	width: 7px;
	height: 40px;
	background: url('../image/box_right.png') no-repeat;
}
.box > .heading h1 {
	background-position:  2px 9px;
	background-repeat: no-repeat;
	margin: 0px;
	padding: 11px 0px 11px 30px;
	color: #003A88;
	font-size: 16px;
	float: left;
}
.box > .heading .buttons {
	float: right;
	padding-top: 8px;
}
.box > .content {
	padding: 10px;
	border-left: 1px solid #CCCCCC;
	border-right: 1px solid #CCCCCC;
	border-bottom: 1px solid #CCCCCC;
	min-height: 300px;
}
#container .button {
	padding-left: 8px;
	display: inline-block;
	text-decoration:none;
	margin-right: 5px;
	background: url('../image/button_left.png') top left no-repeat;
}
#container .button span {
	color: #FFF;
	display: block;
	text-decoration:none;
	padding: 5px 10px 5px 2px;
	background: url('../image/button_right.png') top right no-repeat;
}
.list {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	margin-bottom: 20px;
}
.list td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;

	
}
.list thead td {
	background-color: #EFEFEF;
	padding: 5px 5px;
}
.list thead td a, .list thead td {
	text-decoration: none;
	color: #222222;
	font-weight: bold;
}
.list tbody a {
	text-decoration: underline;
}
.list tbody td {
	vertical-align: middle;
	padding: 5px 5px;
	font-size:11px;
}
.list tbody tr:odd {
	background: #FFFFFF;
}
.list tbody tr:even {
	background: #E4EEF7;
}
.list .left {
	text-align: left;
	padding: 7px;
}
.list .right {
	text-align: right;
	padding: 7px;
}
.list .center {
	text-align: center;
	padding: 7px;
}
.list .asc {
	padding-right: 15px;
	background: url('../image/asc.png') right center no-repeat;
}
.list .desc {
	padding-right: 15px;
	background: url('../image/desc.png') right center no-repeat;
}
.list .filter td {
	padding: 5px;
	background: #E7EFEF;
}
.list td.filternew {
	padding: 5px;
	font-weight: bold;
	vertical-align: top;
	background: #E7EFEF;
}
.pagination {
	margin-top: 30px;
	border-top: 1px solid #EEEEEE;
	background: #F8F8F8;
	display: inline-block;
	width: 100%;
}
.pagination .links, .pagination .results {
	padding: 9px;
}
.pagination .links {
	float: left;
}
.pagination .links a {
	border: 1px solid #CCCCCC;
	padding: 4px 7px;
	text-decoration: none;
	color: #000000;
}
.pagination .links b {
	border: 1px solid #CCCCCC;
	padding: 4px 7px;
	text-decoration: none;
	color: #000000;
	background: #FFFFFF;
}
.pagination .results {
	float: right;
}
.form {
	width: 100%;
	border-collapse: collapse;
	margin-bottom: 20px;
}
table.form tr td:first-child {
	width: 200px;
}
.form > * > * > td {
	padding: 5px;
	color: #000000;
	
}


.form1 {
	width: 100%;
	border-collapse: collapse;
	margin-bottom: 20px;
}

.form1 > * > * > td {
	padding: 5px;
	color: #000000;
	
}

.help {
	color: #999;
	font-size: 10px;
	font-weight: normal;
	font-family: Verdana, Geneva, sans-serif;
	display: block;
}
.req {
	color: #FF0000;
	font-weight: bold;
}
.error {
	color: #FF0000;
	padding-top: 3px;
	display: block;
	font-size: 12px;
	font-weight: normal;
}
.scrollbox {
	border: 1px solid #CCCCCC;
	width: 350px;
	height: 100px;
	background: #FFFFFF;
	overflow-y: scroll;
}
.htabs {
	padding: 0px 0px 0px 10px;
	height: 30px;
	border-bottom: 1px solid #DDDDDD;
	margin-bottom: 15px;
}
.htabs a {
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	border-right: 1px solid #DDDDDD;
	background: #FFFFFF url('../image/tab.png') repeat-x;
	padding: 6px 15px 7px 15px;
	float: left;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	text-align: center;
	text-decoration: none;
	color: #000000;
	margin-right: 2px;
}
.htabs a.selected {
	padding-bottom: 8px;
	background: #FFFFFF;
}
.vtabs {
	width: 180px;
	padding: 10px 0px;
	min-height: 300px;
	float: left;
	display: block;
	border-right: 1px solid #DDDDDD;
}
.vtabs a {
	display: block;
	float: left;
	width: 150px;
	margin-bottom: 5px;
	clear: both;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
	background: #F7F7F7;
	padding: 6px 14px 7px 15px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	text-align: right;
	text-decoration: none;
	color: #000000;
}
.vtabs a.selected {
	padding-right: 15px;
	background: #FFFFFF;
}
.vtabs_page {
	margin-left: 195px;
}
.scrollbox div {
	padding: 3px;
}
.scrollbox div input {
	margin: 0px;
	padding: 0px;
	margin-right: 3px;
}
.scrollbox div.even {
	background: #FFFFFF;
}
.scrollbox div.odd {
	background: #E4EEF7;
}

.add {
	-moz-background-clip:border;
	-moz-background-inline-policy:continuous;
	-moz-background-origin:padding;
	background:transparent url(../image/add.png) no-repeat scroll right center;
	color:#000000;
	display:inline-block;
	padding-right:20px;
	cursor: pointer;
}
.remove {
	-moz-background-clip:border;
	-moz-background-inline-policy:continuous;
	-moz-background-origin:padding;
	background:transparent url(../image/delete.png) no-repeat scroll right center;
	color:#000000;
	display:inline-block;
	padding-right:20px;
	cursor: pointer;
}
.red{ color:#FF0000; font-weight:bold;}
.green{ color:#006600; font-weight:bold;}
.orange{ color:#FF6600; font-weight:bold;}
.print{ padding:10px;}
@font-face{font-family: 'WebRupee';src: url('fonts/WebRupee.V2.0.eot');src: local('WebRupee'), url('fonts/WebRupee.V2.0.ttf') format('truetype'),  url('fonts/WebRupee.V2.0.woff') format('woff'), url('fonts/WebRupee.V2.0.svg') format('svg');font-weight: normal;font-style: normal;}
.WebRupee{font-family: 'WebRupee'; font-size:14px;}


.list1 {
	/*border-collapse: collapse;
	width: auto;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	margin-bottom: 20px;*/
	
	width:100%;border-collapse:collapse;
}
/*.list1 td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
	
	
}
.list1 thead td {
	background-color: #EFEFEF;
	padding: 5px 5px;
	width:60px;
	font-size:11px;
	font-weight:bold;
	
}
.list1 tbody td {
	vertical-align: middle;
	padding: 5px 5px;
	font-size:11px;
	width:60px;
	
}
.list1 .left {
	text-align: left;
	padding: 7px;
}
.list1 .right {
	text-align: right;
	padding: 7px;
}
.list1 .center {
	text-align: center;
	padding: 7px;
}
.list1 thead tr{ width:100%; display:block;}
.list1 tbody {display:block; overflow-y:scroll; height:300px; }

table.list1 thead tr td:first-child{ width:130px;}
table.list1 tbody td:first-child{ width:130px;}
table.list1 tbody td:last-child{ width:43px;}



*/
.GridviewScrollHeader TH, .GridviewScrollHeader TD
{
    padding: 5px;
    font-weight: bold;
    white-space: nowrap;
    border-right: 1px solid #AAAAAA;
    border-bottom: 1px solid #AAAAAA;
    background-color: #EFEFEF;
    vertical-align: bottom;
    text-align: left;
}
.GridviewScrollItem TD
{
    padding: 5px;
    white-space: nowrap;
    border-right: 1px solid #AAAAAA;
    border-bottom: 1px solid #AAAAAA;
    background-color: #FFFFFF;
}
.GridviewScrollItem .Freeze
{
    background-color: #EFEFEF;
}
.GridviewScrollItemHover TD
{
    padding: 5px;
    white-space: nowrap;
    border-right: 1px solid #AAAAAA;
    border-bottom: 1px solid #AAAAAA;
    background-color: #CCCCCC;
    cursor: pointer;
}
.GridviewScrollItemHover .Freeze
{
    background-color: #CCCCCC;
}
.GridviewScrollItemSelected TD
{
    padding: 5px;
    white-space: nowrap;
    border-right: 1px solid #AAAAAA;
    border-bottom: 1px solid #AAAAAA;
    background-color: #999999;
    color: #FFFFFF;
}
.GridviewScrollItemSelected .Freeze
{
    background-color: #999999;
}
.GridviewScrollPager 
{
    border-top: 1px solid #AAAAAA;
    background-color: #FFFFFF;
}
.GridviewScrollPager TD
{
    padding-top: 3px;
    font-size: 14px;
    padding-left: 5px;
    padding-right: 5px;
}
.GridviewScrollPager A
{
    color: #666666;
}

.GridviewScrollPager SPAN
{
    font-size: 16px;
    font-weight: bold;
}
.list td{ padding:3px !important;}
</style>
</head>
<body>

    <div class="content" style="padding:0 50px;">
	<p align="center"><strong>Ledger Period :  <?php echo date("d-m-Y", strtotime($open_date));?> to <?php echo date("d-m-Y", strtotime($to_date));?></strong></p>
	<div style="font-size:14px;">
    <div align="right" style="font-size:12px;">
    <b class="title_name">TUMBLEDRY SOLUTIONS PRIVATE LIMITED</b><br /> 
    
5, 512-B, 98-MODI TOWER, NEHRU PLACE, NEW DELHI,<br>
South East Delhi, New Delhi, Delhi 110019<br>
01204317564<br>
GSTIN 07AAHCT2140E1ZP<br>
PAN AAHCT2140E<br>
CIN U74999DL2019PTC347046
 </div>
<hr />


<b class="title_name">  <?php echo $storebalance['firm_name']?> </b>
<BR />
<?php echo $storebalance['store_address']?>



</div>
<br /><br />
<table id="" class="list" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <td>Voucher No.</td>
                                    <td>Voucher Type</td>
                                    <td>Voucher Date</td>
                                    <td>Sale</td>
                                    <td>Receipt</td>
                                    <td>Debit</td>
                                    <td>Credit</td>
                                    <td>Descriptions</td>
                                    <td>Total</td>
                                   
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                <th>Customer Name</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                             -->
                            <tbody>

                            <tr>
                            <td>-</td>
                            <td>Opening Balance</td>
                            <td><?php echo date("d-m-Y", strtotime($open_date));?></td>
                            <td><?php echo $total_balalnce=$storebalance['openbalance'];?></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><?php echo $total_balalnce=$storebalance['openbalance'];?></td>
                            
                            </tr>  

                            <?php 
                        
                          //  print_r($ledgerItems);

foreach($ledgerItems as $li){?> 

<tr>
                            <td><?php echo $li['voucher_no'];?></td>    
                            <td><?php echo $li['voucher_type'];?></td>
                            <td><?php echo date("d-m-Y", strtotime($li['voucher_date']));?></td>
                            <td><?php if($li['voucher_type']=='Sale'){echo $li['np']; $total_balalnce+=$li['np'];}?></td>
                            <td><?php if($li['voucher_type']=='R'){echo $li['np'];$total_balalnce-=$li['np'];}?></td>
                            <td><?php if($li['voucher_type']=='D'){echo $li['np'];$total_balalnce+=$li['np'];}?></td>
                            <td><?php if($li['voucher_type']=='C'){echo $li['np'];$total_balalnce-=$li['np'];}?></td>
                            <td><?php echo  $li['descriptions'];?></td>
                            <td><?php echo $total_balalnce;?></td>
                            
                            </tr>  


<?php }

?>
                           
                            
                        
                            </tbody>


                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th><strong><?php echo $total_balalnce;?></strong></th>
                                   
                                </tr>
                            </tfoot>


                        </table>
	 </div>

</body></html>