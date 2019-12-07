

<!-- Container fluid  -->

<div class="container-fluid">
    
    <!-- Bread crumb and right sidebar toggle -->
    
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Voucher</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">All Vouchers</li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">
            
            
            <div class="d-flex m-t-10 justify-content-end">
                <!-- <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0"><small>Active Store</small></h6>
                        <h4 class="m-t-0 text-info">21</h4>
                    </div>
                </div> -->
                <!-- <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0"><small>Inctive User</small></h6>
                        <h4 class="m-t-0 text-primary"><?php echo $count->inactive_user; ?></h4>
                    </div>
                </div> -->
                
            </div>
        </div>
    </div>
    
    <!-- End Bread crumb and right sidebar toggle -->
    

    
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-12">

            <?php $msg = $this->session->flashdata('msg'); ?>
            <?php if (isset($msg)): ?>
                <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>

            <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>

            <div class="card">

                <div class="card-body">

                <?php if ($this->session->userdata('role') == 'admin'): ?>
                    <a href="<?php echo base_url('admin/voucher/add') ?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Voucher</a> &nbsp;

                   
                <?php else: ?>
                    <!-- check logged user role permissions -->

                    <?php if(check_power(1)):?>
                        <a href="<?php echo base_url('admin/voucher/add') ?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Voucher</a>
                    <?php endif; ?>
                <?php endif ?>
                

                    <div class="table-responsive m-t-40">
                        
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
    <tr>
		<th>ID</th>
		<th>Voucher Type</th>
		<th>Store Id</th>
		<th>Amount</th>
		<th>Create Date</th>
		<th>Actions</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>ID</th>
        <th>Voucher Type</th>
        <th>Store Id</th>
        <th>Amount</th>
        <th>Create Date</th>
        <th>Actions</th>
    </tr>
    </tfoot>
    <tbody>

	<?php foreach($vouchers as $v){ ?>
    <tr>
		<td><?php echo $v['id']; ?></td>
		<td><?php echo $v['voucher_type']; ?></td>
		<td><?php echo $v['store_crm_code']; ?></td>
		<td><?php echo $v['amount']; ?></td>
		<td><?php echo $v['create_date']; ?></td>
		<td>
            <!-- <a href="<?php //echo site_url('admin/voucher/edit/'.$v['id']); ?>">Edit</a> -->  
            <a href="<?php echo base_url('admin/voucher/edit/'.$v['id']); ?>" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-success m-r-10"></i> </a>

            <!-- <a href="<?php //echo site_url('admin/voucher/remove/'.$v['id']); ?>">Delete</a> -->
            <a id="delete" data-toggle="modal" data-target="#confirm_delete_<?php echo $v['id'];?>" href="#"  data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-trash text-danger m-r-10"></i> </a>
        </td>
    </tr>
	<?php } ?>
</tbody>
</table>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>    
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Page Content -->

</div>

<?php foreach ($vouchers as $v): ?>
 
<div class="modal fade" id="confirm_delete_<?php echo $v['id'];?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       
            <div class="form-body">
                
                Are you sure want to delete? <br> <hr>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="<?php echo base_url('admin/voucher/remove/'.$v['id']); ?>" class="btn btn-danger"> Delete</a>
                
            </div>

      </div>


    </div>
  </div>
</div>


<?php endforeach ?>

