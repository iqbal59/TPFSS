

<!-- Container fluid  -->

<div class="container-fluid">
    
    <!-- Bread crumb and right sidebar toggle -->
    
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Service</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Add New Service</li>
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
                    <h4 class="m-b-0 text-white"> Add New Service <a href="<?php echo base_url('admin/service/') ?>" class="btn btn-info pull-right"><i class="fa fa-list"></i> All Serivces </a></h4>

                </div>
                <div class="card-body">
                   
                <?php echo form_open('admin/service/add'); ?>

<div>
    Name : 
    <input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" />
</div>
<div>
    <span class="text-danger">*</span>Code : 
    <input type="text" name="code" value="<?php echo $this->input->post('code'); ?>" />
    <span class="text-danger"><?php echo form_error('code');?></span>
</div>
<div>
    Sac Code : 
    <input type="text" name="sac_code" value="<?php echo $this->input->post('sac_code'); ?>" />
</div>
<div>
    Royality : 
    <input type="text" name="royality" value="<?php echo $this->input->post('royality'); ?>" />
</div>

<button type="submit">Save</button>

<?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- End Page Content -->

</div>