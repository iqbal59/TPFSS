
 <html>

<head>
<link href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
</head>

 <body onload="window.print();">
 
<div class="container">
	
    <div class="row">
        <div class="col-xs-12">
	        <div align="center"><h3 class="center">TAX INVOICE</h3></div>
    		<div class="invoice-title">
    			<!-- <h2><img src="<?php echo base_url();?>/assets/images/logo.jpg"/></h2> -->
    			<h3 class="pull-right">Invoice No. # <?php echo $invoice->id;?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    			    <address>
    				<strong>Billed To:</strong><br>
    			    				
    				
                    <?php echo $invoice->firm_name;?> <br>
                    <?php echo $invoice->contact_number;?> <br>
    					
                    <span><?php echo $invoice->store_address;?></span> <br/>
						
    				</address>
    			    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
<!--         			<strong>Laundry </strong><br> -->
    					<div style="width:300px;float:right;font-size:11px;"> 
<!-- 							<span style='font-weight:bold;'> tumbledry </span> <br/> -->
							<span styl='font-size:11px;'>
							TUMBLEDRY SOLUTIONS PRIVATE LIMITED<br>
5, 512-B, 98-MODI TOWER, NEHRU PLACE, NEW DELHI,<br>
South East Delhi, New Delhi, Delhi 110019<br>
01204317564<br>
GSTIN 07AAHCT2140E1ZP<br>
PAN AAHCT2140E<br>
CIN U74999DL2019PTC347046
							 </span> 
				
						</div>
    					
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
					<strong>Order Date:</strong>
    					<?php echo date("d-m-Y", strtotime($invoice->invoice_date));?> <br><br>    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				
    			</div>
    			
    			
    		</div>
    	</div>
    </div>
    
    
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Sr. No.</strong></td>
        						
									<td style='width:200px;'><strong>Description</strong></td>
        							<td ><strong>SAC Code</strong></td>
        							<td class="text-center"><strong>Qty</strong></td>
									<td class="text-center"><strong>Rate/Unit</strong></td>
        							<td class="text-right"><strong>Taxable Value</strong></td>
                                </tr>
    						</thead>
    						<tbody>
							<tr><td colspan="7"></td></tr>
    										
                                            
                                            <?php 
                                            $i=1;
                                            $qty=0;
                                            foreach ($invoiceitems as $ord) {?>
                                            	<tr>
													<td class="no-line"> <?php echo $i++;?> </td> 
													
													
													<td class="no-line" style='width:250px;' > 
																											
														<?php echo $ord->item_name;?>
														
													</td> 
													
													<td class="no-line" > 
														
													- </td>	
													<td class="no-line text-center" > 	<?php echo $ord->qty; $qty+=$ord->qty;?> </td>
													 
													<td class=" no-line text-center" > 	<?php echo $ord->rate;?> </td> 
													
													
													
													
													
													<td class=" no-line text-right" > 
                                                    <?php echo sprintf("%0.2f",($ord->qty*$ord->rate));?>
													
														
													
													</td> 													
													
													
													</tr>



                                            <?php }?>

														
                                                        
                                                        
                                                        		<tr>






    								<td colspan="4"></td>
    								
    								
<!--     								<td class=" text-center"></td> -->
									<td class=" text-center">Sub Total : </td>
    								
    								<td class=" text-right">Rs. <?php echo $invoice->amount;?>  </td>
    							</tr>
								
								
								
								
								<tr>
																		
													
													
													
														  
													
													
													<!-- Percentage Section --> 
													
																										   												
													
													
																									
												
																										
															<!-- End Percentage Section -->
													
													
												<!-- Amount Section --> 
													 
													<!-- End Amount Section -->
													
													
													
													
													<tr> <td  colspan='4'></td> <td style='text-align:center;'>SGST(9%) : </td><td style='text-align:right;'>Rs. <?php echo $invoice->tax_amount/2;?></td></tr>	
                                                    <tr> <td  colspan='4'></td> <td style='text-align:center;'>CGST(9%) : </td><td style='text-align:right;'>Rs. <?php echo $invoice->tax_amount/2;?></td></tr>	
											
												
											
    							<tr>
    								
    								<td class="thick-line" colspan="4"></td>
    							
    								<td class="thick-line text-center"><strong>Net Amount </strong></td>
    								<td class="thick-line text-right">  Rs. <?php echo $invoice->net_amount;?> </td>
									
								</tr>
								<tr> <td class="thick-line" colspan="7"></td></tr>
								
    						</tbody>
    					</table>
    				</div>
    			</div>
    			
    			<center> Toll Free: 1800-1031-831 email: hello@tumbledry.in web: www.tumbledry.in</center> <br/>
    			
				<center style="font-size: 9px;"> This is computer generated Invoice no signature required </center> <br/>
    		</div>
    	</div>
    </div>
</div>
         
</body>
<html>

