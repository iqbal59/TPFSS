<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
  $this->load->view('layout/header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section style="padding: 1px 15px 0 15px;" class="content-header">
      <h5>
        <ol style="margin-bottom: -10px;" class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a href="<?php echo base_url('store/index'); ?>">Store</a></li>
          <li class="active">Deactive Store</li>
        </ol>
      </h5>    
    </section>
<!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Store Royality <?php echo $rlt->store_code?></h3>
              <?php // $rlt->store_id; ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open("store/royality/$id",'class="form-horizontal row-border"');?>
              <div class="box-body" style="padding: 20px">

              	<input type="hidden" name="store_code" value="<?= $rlt->store_code; ?>">
              <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Service Code</th>
                            <th scope="col">Service Name</th>
                            <th scope="col">Defualt Royalty (%)</th>
                            <th scope="col">Royalty (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>CL</th>
                            <td>Cleaning</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="CL" value="<?php echo set_value('CL',$rlt->CL); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>DC</td>
                            <td>Dry Cleaning</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="DC" value="<?php echo set_value('DC',$rlt->DC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>RF</td>
                            <td>Raffu</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="RF" value="<?php echo set_value('RF',$rlt->RF); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>SDC</td>
                            <td>Starching DC</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="SDC" value="<?php echo set_value('SDC',$rlt->SDC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>SI</td>
                            <td>Steam Iron</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="SI" value="<?php echo set_value('SI',$rlt->SI); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>STC</td>
                            <td>Starching</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="STC" value="<?php echo set_value('STC',$rlt->STC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>HPC</td>
                            <td>Hanger Packing By Pc</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="HPC" value="<?php echo set_value('HPC',$rlt->HPC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>STDC</td>
                            <td>Starching With DC</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="STDC" value="<?php echo set_value('STDC',$rlt->STDC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>HC</td>
                            <td>Home Cleaning</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="HC" value="<?php echo set_value('HC',$rlt->HC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>HP</td>
                            <td>Hanger Packing</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="HP" value="<?php echo set_value('HP',$rlt->HP); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>PL</td>
                            <td>Premium Laundry</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="PL" value="<?php echo set_value('PL',$rlt->PL); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>PP</td>
                            <td>Premium Packaging</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="PP" value="<?php echo set_value('PP',$rlt->PP); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>SPC</td>
                            <td>Spot Cleaning</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="SPC" value="<?php echo set_value('SPC',$rlt->SPC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>STR</td>
                            <td>Starching with Laundry</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="STR" value="<?php echo set_value('STR',$rlt->STR); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>WF</td>
                            <td>Wash and Fold</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="WF" value="<?php echo set_value('WF',$rlt->WF); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>WSI</td>
                            <td>Wash and Steam Iron</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="WSI" value="<?php echo set_value('WSI',$rlt->WSI); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>ULO</td>
                            <td>Unlimited Laundry Offer</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="ULO" value="<?php echo set_value('ULO',$rlt->ULO); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>SC</td>
                            <td>Shoe Cleaning</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="SC" value="<?php echo set_value('SC',$rlt->SC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>SHC</td>
                            <td>Shoe Cleaning</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="SHC" value="<?php echo set_value('SHC',$rlt->SHC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>HMC</td>
                            <td>Home Cleaning</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="HMC" value="<?php echo set_value('HMC',$rlt->HMC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>WL</td>
                            <td>Wollen Laundry</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="WL" value="<?php echo set_value('WL',$rlt->WL); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>WLS</td>
                            <td>Woolen Laundry Service</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="WLS" value="<?php echo set_value('WLS',$rlt->WLS); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>LCD</td>
                            <td>Lint Cleaning Dry Clean</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="LCD" value="<?php echo set_value('LCD',$rlt->LCD); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>WLW</td>
                            <td>Woolen Laundry (Wash & Fold)</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="WLW" value="<?php echo set_value('WLW',$rlt->WLW); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>SNTZ</td>
                            <td>Sanitization</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="SNTZ" value="<?php echo set_value('SNTZ',$rlt->SNTZ); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>LFW</td>
                            <td>Laundry for Whites</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="LFW" value="<?php echo set_value('LFW',$rlt->LFW); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>FSHC</td>
                            <td>Shoe Cleaning</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="FSHC" value="<?php echo set_value('FSHC',$rlt->FSHC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>SFC</td>
                            <td>Shoe Cleaning</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="SFC" value="<?php echo set_value('SFC',$rlt->SFC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>SHDC</td>
                            <td>Shoe Cleaning</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="SHDC" value="<?php echo set_value('SHDC',$rlt->SHDC); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                        <tr>
                            <td>RPCL</td>
                            <td>Reprocessing</td>
                            <td>7.50</td>
                            <td>
                                <input type="number" name="RPCL" value="<?php echo set_value('RPCL',$rlt->RPCL); ?>" required="" min="0" max="100" step="0.001">
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <?php date_default_timezone_set('Asia/Kolkata');
                      $update=date('Y-m-d G:i:s'); 
                      // echo $update; 
                ?> 
                <input type="hidden" name="updated_at" class="form-control form-control-sm" value="<?php echo $update; ?> ">
                                
				  	


			  <!-- <?php // echo form_hidden($csrf); ?>
			  <?php // echo form_hidden(array('id'=>$id)); ?> -->
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="submit" class="btn btn-info" value="Submit">
                <!-- <?php // echo form_submit('submit','Submit','class="btn btn-info "');?> -->
                <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('store')">Cancel</span>
              </div>
              <!-- /.box-footer -->
            <?php echo form_close();?>
          </div>
        </div>
      </div>
      <!-- /.row -->
      
    </section>
    <!-- /.content -->

  </div>

<?php 
  $this->load->view('layout/footer');
?>

