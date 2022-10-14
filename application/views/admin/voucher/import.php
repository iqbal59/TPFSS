

<!-- Container fluid  -->

<div class="container-fluid">
    
    <!-- Bread crumb and right sidebar toggle -->
    
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Voucher</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"> Import Voucher</li>
            </ol>
        </div>
        
    </div>
    
    <!-- End Bread crumb and right sidebar toggle -->
    

    
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>
            
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Import Voucher <a href="<?php echo base_url('admin/voucher/') ?>" class="btn btn-info pull-right"><i class="fa fa-list"></i> All Voucher </a></h4>

                </div>
                <div class="card-body">
            
                <?php echo form_open_multipart('admin/voucher/importvoucher'); ?>

	

				<div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Voucher Type :  </label>
                                        <div class="col-md-9 controls">
										<select name="voucher_type" class="form-control">
			<option value="">select</option>
			<?php 
			$voucher_type_values = array(
				'C'=>'Credit',
				'R'=>'Receipt',
				'D'=>'Debit',
			);

			foreach($voucher_type_values as $value => $display_text)
			{
				$selected = ($value == $this->input->post('voucher_type')) ? ' selected="selected"' : "";

				echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
			} 
			?>
		</select>
		<span class="text-danger"><?php echo form_error('voucher_type');?></span>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>




							
							

							<div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Choose CSV file :  </label>
                                        <div class="col-md-9 controls">
                                        <input type="file" name="excel_file" class="form-control" required data-validation-required-message="file is required">
		                                <span class="text-danger"><?php echo form_error('excel_file');?></span>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>



	
	
	<hr/>
	<div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3"></label>
                                        <div class="controls">
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

<?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>

    <!-- End Page Content -->

</div>