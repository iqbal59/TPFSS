

<!-- Container fluid  -->

<div class="container-fluid">
    
    <!-- Bread crumb and right sidebar toggle -->
    
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Voucher</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Add New Voucher</li>
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
                    <h4 class="m-b-0 text-white"> Add New Voucher <a href="<?php echo base_url('admin/voucher/') ?>" class="btn btn-info pull-right"><i class="fa fa-list"></i> All Voucher </a></h4>

                </div>
                <div class="card-body">
            
                <?php echo form_open('admin/voucher/add'); ?>

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3"><span class="text-danger">*</span>Voucher Type </label>
                                        <div class="col-md-9 controls">
                                            <div class="form-group has-success">
                                                <select class="form-control custom-select" name="voucher_type" aria-invalid="false">
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
                                	</div>
	                            </div>


                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3"><span class="text-danger">*</span>Store Id </label>
                                        <div class="col-md-9 controls">
                                            <div class="form-group has-success">
                                                <select class="form-control custom-select" name="store_id" aria-invalid="false">
													<option value="">select</option>
													<?php 
													foreach($stores as $s)
													{
														$selected = ($s['id'] == $this->input->post('store_id')) ? ' selected="selected"' : "";

														echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['store_name'].' '.$s['store_crm_code'].'</option>';
													} 
													?>
											        </select>
											        <span class="text-danger"><?php echo form_error('store_id');?></span>
                                    
                                            	</div>
                                        	</div>
                                    	</div>
                                	</div>
	                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3"><span class="text-danger">*</span>Amount </label>
                                        <div class="col-md-9 controls">
                                            <input type="text" name="amount" class="form-control" value="<?php echo $this->input->post('amount'); ?>">
                                		<span class="text-danger"><?php echo form_error('amount');?></span>
            
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-6"></label>
                                        <div class="controls">
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

<!-- 	<div>
		<span class="text-danger">*</span>Voucher Type : 
		<select name="voucher_type">
			<option value="">select</option>
			<?php 
			/*$voucher_type_values = array(
				'C'=>'Credit',
				'R'=>'Receipt',
				'D'=>'Debit',
			);

			foreach($voucher_type_values as $value => $display_text)
			{
				$selected = ($value == $this->input->post('voucher_type')) ? ' selected="selected"' : "";

				echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
			}*/ 
			?>
		</select>
		<span class="text-danger"><?php //echo form_error('voucher_type');?></span>
	</div>
 -->

<!-- 	<div>
		<span class="text-danger">*</span>Store Id : 
		
		
        <select name="store_id">
			<option value="">select</option>
			<?php 
			/*foreach($stores as $s)
			{
				$selected = ($s['id'] == $this->input->post('store_id')) ? ' selected="selected"' : "";

				echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['store_name'].' '.$s['store_crm_code'].'</option>';
			}*/ 
			?>
		</select>
        
        <span class="text-danger"><?php //echo form_error('store_id');?></span>
	</div>
 -->


<!--  	<div>
		<span class="text-danger">*</span>Amount : 
		<input type="text" name="amount" value="<?php //echo $this->input->post('amount'); ?>" />
		<span class="text-danger"><?php //echo form_error('amount');?></span>
 	</div>-->
	
	<!-- <button type="submit">Save</button> -->

<?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>

    <!-- End Page Content -->

</div>