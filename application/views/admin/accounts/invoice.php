<style>
body {
    font-size: 12px;
}

.title_name {
    font-size: 16px;
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

.list thead td a,
.list thead td {
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
    font-size: 11px;
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
</style>



<div>

    <p align="right"><img src="<?php echo base_url('assets/images/logo-light-login.png'); ?>" /></p>
    <table class="list">

        <tbody>
            <tr style='height:16px;'>

                <td colspan="9" class="center"><span style="font-size:12pt;font-family:Arial;">TAX INVOICE</span></td>
            </tr>
            <tr>

                <td class="right" colspan="9">ORIGINAL FOR RECIPIENT</td>
            </tr>
            <tr>

                <td colspan="9">&nbsp;</td>
            </tr>

            <tr style='height:89px;'>
                <td colspan="5">
                    <span style="font-size:9pt;font-family:Calibri,Arial;color:#808080;">From<br></span><span
                        style="font-size:9pt;font-family:Arial;">TUMBLEDRY SOLUTIONS PRIVATE LIMITED<br></span><span
                        style="font-size:9pt;font-family:Calibri,Arial;">FF-42, Gardenia Glory,Sector 46, Noida,Gautam
                        Buddha Nagar, Uttar Pradesh, 201301
                        110019<br></span><span style="font-size:9pt;font-family:Calibri,Arial;">GSTIN </span><span
                        style="font-size:9pt;font-family:Arial;">09AAHCT2140E1ZL<br></span><span
                        style="font-size:9pt;font-family:Calibri,Arial;">PAN </span><span
                        style="font-size:9pt;font-family:Arial;">AAHCT2140E</span><br />
                </td>
                <td colspan="2" style="vertical-align:top">
                    <span style="font-size:9pt;font-family:Calibri,Arial;">Invoice No.<br /></span>
                    <span style="font-size:9pt;font-family:Calibri,Arial;">Invoice Date</span><br />
                </td>
                <td colspan="2" style="vertical-align:top">
                    <span style="font-size:9pt;font-family:Calibri,Arial;">:
                        TD/R-<?php echo $invoice->id;?>/21-22<br /></span>
                    <span style="font-size:9pt;font-family:Calibri,Arial;">:
                        <?php echo date('d/m/Y', strtotime($invoice->invoice_date));?></span><br />
                </td>
            </tr>

            <!-- <tr>

                <td colspan="2"><span style="font-size:9pt;font-family:Calibri,Arial;">Transport Name
                        Mode<br></span><span style="font-size:9pt;font-family:Calibri,Arial;">LR No &amp;
                        Date<br></span><span style="font-size:9pt;font-family:Calibri,Arial;">STORE CODE</span></td>
                <td colspan="2"><span style="font-size:9pt;font-family:Calibri,Arial;">: BY
                        HAND<br></span><span style="font-size:9pt;font-family:Calibri,Arial;">: BY HAND<br></span><span
                        style="font-size:9pt;font-family:Calibri,Arial;">: <?php echo $invoice->store_code;?></span>
                </td>
            </tr> -->

            <tr style='height:89px;'>

                <td colspan="3"><span style="font-size:9pt;font-family:Calibri,Arial;color:#808080;">Billing
                        Address<br></span><span style="font-size:9pt;font-family:Arial;">M/s
                        <?php echo $invoice->firm_name;?><br></span><span
                        style="font-size:9pt;font-family:Calibri,Arial;"><?php echo $invoice->store_address;?></span><br />
                    <span style="font-size:9pt;font-family:Calibri,Arial;">GSTIN NO.
                        <?php echo $invoice->gstin_no; ?></span>
                </td>
                <td colspan="6"><span style="font-size:9pt;font-family:Calibri,Arial;color:#808080;">Shipping
                        Address<br></span><span style="font-size:9pt;font-family:Arial;">M/s
                        <?php echo $invoice->firm_name;?><br></span><span
                        style="font-size:9pt;font-family:Calibri,Arial;"><?php echo $invoice->store_address;?></span><br><span
                        style="font-size:9pt;font-family:Calibri,Arial;">GSTIN NO.
                        <?php echo $invoice->gstin_no;  $stcode=substr($invoice->gstin_no, 0, 2);?></span></td>
            </tr>



            <tr style='height:16px;'>

                <td class="s5"><span style="font-size:7pt;font-weight:bold;font-family:Arial;">Sr. No.</span></td>
                <td class="s5" <?php echo  $stcode=='09'?"":"colspan='2'";?>><span
                        style="font-size:7pt;font-weight:bold;font-family:Arial;">Description</span></td>
                <td class="s5"><span style="font-size:7pt;font-weight:bold;font-family:Arial;">HSN / SAC</span></td>
                <td class="s6"><span style="font-size:7pt;font-weight:bold;font-family:Arial;">Order Value</span></td>
                <td class="s6"><span style="font-size:7pt;font-weight:bold;font-family:Arial;">Royalty percenatge</span>
                </td>
                <td class="s5 center"><span style="font-size:7pt;font-weight:bold;font-family:Arial;">Taxable
                        Value</span></td>

                <?php if($stcode=='09'){?>
                <td class="s6 center"><span style="font-size:7pt;font-weight:bold;font-family:Arial;">SGST</span></td>
                <td class="s6 center"><span style="font-size:7pt;font-weight:bold;font-family:Arial;">CGST</span></td>

                <?php } else {?>
                <td class="s6 center"><span style="font-size:7pt;font-weight:bold;font-family:Arial;">IGST</span></td>
                <?php }?>

                <td class="s5 center"><span style="font-size:7pt;font-weight:bold;font-family:Arial;">Total
                        Amount</span></td>
            </tr>

            <?php 
			 $i=1; 
			 $ot=0;
			 $sgst_total=0;
			 $cgst_total=0;
             $igst_total=0;
			 $taxable_total=0;
			 $total=0; 
		   foreach($invoiceitems as $inv){?>

            <tr style='height:16px;'>

                <td class="s7"><?php echo $i++;?></td>
                <td class="s7" <?php echo  $stcode=='09'?"":"colspan='2'";?>><?php echo $inv->name;?></td>
                <td class="s7"><?php echo $inv->sac_code;?></td>
                <td class="s8" align="right"><?php echo number_format($inv->amount,2);$ot+=$inv->amount;?></td>
                <td class="s8" align="right"><?php echo $inv->royalty;?></td>
                <td class="s8" align="right"><?php echo number_format($inv->rate,2); $taxable_total+=$inv->rate;?></td>

                <?php if($stcode=='09'){?>
                <td class="s7 right">
                    <?php 
                 $sgst=round($inv->rate*9/100,2); 
                 echo number_format($sgst, 2);
                $sgst_total+=$sgst;
                ?>
                </td>
                <td class="s7 right">
                    <?php  $cgst=round($inv->rate*9/100,2); echo number_format($cgst, 2); $cgst_total+=$cgst;?></td>
                <?php } else {?>
                <td class="s7 right">
                    <?php  $igst=round($inv->rate*18/100,2); echo number_format($igst, 2); $igst_total+=$igst;?></td>
                <?php }?>
                <td class="s7 right">
                    <?php echo number_format(($inv->rate+$sgst+$cgst),2); $total+=($inv->rate+$sgst+$cgst); ?></td>
            </tr>
            <?php }?>


            <tr style='height:33px;'>

                <td class="s9 left" <?php echo  $stcode=='09'?"colspan='2'":"colspan='3'";?>><span
                        style="font-size:9pt;font-family:Arial;">TOTAL (₹)</span></td>
                <td class="s10"></td>
                <td class="s10 right"><?php echo number_format($ot,2);?></td>
                <td class="s10"></td>
                <td class="s10 right"><?php echo number_format($taxable_total,2);?></td>
                <?php if($stcode=='09'){?>
                <td class="s10 right"><?php echo number_format($sgst_total,2);?></td>
                <td class="s10 right"><?php echo number_format($cgst_total,2);?></td>
                <?php } else {?>

                <td class="s10 right"><?php echo number_format($igst_total,2);?></td>
                <?php }?>

                <td class="s10 right"><?php echo number_format($total,2);?></td>
            </tr>
            <tr style='height:16px;'>

                <td class="s11" colspan="6" rowspan="2"></td>
                <td class="s12 " colspan="2"><span style="font-size:10pt;font-family:Calibri,Arial;">Taxable
                        Amount</span></td>
                <td class="s7 right"><?php echo number_format($taxable_total,2);?></td>
            </tr>
            <tr style='height:16px;'>

                <td class="s12" colspan="2"><span style="font-size:10pt;font-family:Calibri,Arial;">Total Tax</span>
                </td>
                <td class="s7 right"><?php echo number_format($cgst_total+$sgst_total+$igst_total,2);?></td>
            </tr>
            <tr style='height:37px;'>

                <td class="s3 left" colspan="6"><span style="font-size:10pt;font-family:Calibri,Arial;">Total amount (in
                        words) :</span>
                    <span style="font-size:10pt;font-family:Arial;"><?php echo convert_number($total);?></span>
                </td>
                <td class="s13" colspan="2"><span style="font-size:10pt;font-family:Arial;">Total Amount</span></td>
                <td class="s7 right"><?php echo number_format($total,2);?></td>
            </tr>
            <tr style='height:157px;'>

                <td class="s14 left" colspan="9">
                    <strong>Remarks:</strong><br />
                    <p>Royalty for the period of <?php echo $invoice->descriptions;?>.</p>

                    <span style="font-size:9pt;font-family:Arial;">TUMBLEDRY SOLUTIONS
                        PRIVATE<br></span><span
                        style="font-size:9pt;font-family:Arial;">LIMITED<br><br><br><br></span><span
                        style="font-size:7pt;font-family:Calibri,Arial;">Authorised Signatory</span>
                </td>
            </tr>


        </tbody>
    </table>
    <p><em>It’s a computer generated invoice and does not require any signature.</em></p>
</div>