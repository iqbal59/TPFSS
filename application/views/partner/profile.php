 <!-- ============================================================== -->
 <!-- Container fluid  -->
 <!-- ============================================================== -->
 <div class="container-fluid">
     <!-- ============================================================== -->
     <!-- Bread crumb and right sidebar toggle -->
     <!-- ============================================================== -->
     <div class="row page-titles">
         <div class="col-md-5 col-8 align-self-center">
             <h3 class="text-themecolor m-b-0 m-t-0">Profile</h3>
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                 <li class="breadcrumb-item active">Profile</li>
             </ol>
         </div>

     </div>
     <!-- ============================================================== -->
     <!-- End Bread crumb and right sidebar toggle -->
     <!-- ============================================================== -->
     <!-- ============================================================== -->
     <!-- Start Page Content -->
     <!-- ============================================================== -->
     <!-- Row -->
     <div class="row">
         <!-- Column -->
         <div class="col-lg-4 col-xlg-3 col-md-5">
             <div class="card">
                 <div class="card-body">
                     <center class="m-t-30"> <img src="<?php echo base_url() ?>assets/images/users/1.jpg"
                             class="img-circle" width="150" />
                         <h4 class="card-title m-t-10"><?php echo $storeData['firm_name'];?>
                         </h4>
                         <h6 class="card-subtitle"><?php echo $storeData['store_name'];?>
                         </h6>

                     </center>
                 </div>
                 <div>
                     <hr>
                 </div>
                 <div class="card-body"> <small class="text-muted">Email address </small>
                     <h6><?php echo $storeData['email_id'];?>
                     </h6> <small class="text-muted p-t-30 db">Phone</small>
                     <h6><?php echo $storeData['contact_number'];?>
                     </h6> <small class="text-muted p-t-30 db">Address</small>
                     <h6><?php echo $storeData['store_address'];?>
                     </h6>
                     <!-- <div class="map-box">
                         <iframe
                             src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"
                             width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                     </div> -->


                 </div>
             </div>
         </div>
         <!-- Column -->
         <!-- Column -->
         <div class="col-lg-8 col-xlg-9 col-md-7">

             <?php $msg = $this->session->flashdata('msg'); ?>
             <?php if (isset($msg)): ?>
             <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i>
                 <?php echo $msg; ?> &nbsp;
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                         aria-hidden="true">×</span> </button>
             </div>
             <?php endif ?>

             <?php $error_msg = $this->session->flashdata('error_msg'); ?>
             <?php if (isset($error_msg)): ?>
             <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i>
                 <?php echo $error_msg; ?> &nbsp;
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                         aria-hidden="true">×</span> </button>
             </div>
             <?php endif ?>

             <div class="card">
                 <!-- Nav tabs -->
                 <ul class="nav nav-tabs profile-tab" role="tablist">

                     <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#settings"
                             role="tab">Settings</a> </li>
                 </ul>
                 <!-- Tab panes -->
                 <div class="tab-content">

                     <div class="tab-pane active" id="settings" role="tabpanel">
                         <div class="card-body">

                             <?php
                             //print_r($this->session->userdata());
                            // print_r($storeData);
                             ?>
                             <form class="form-horizontal form-material" method="post"
                                 action="<?php echo base_url('partner/profile')?>">
                                 <input type="hidden" name="store_id" value="<?php echo $storeData['id'];?>" />



                                 <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
                                     value="<?=$this->security->get_csrf_hash();?>" />


                                 <div class="form-group">
                                     <label class="col-md-12">Current Password</label>
                                     <div class="col-md-12">
                                         <input type="password" name="cur_password"
                                             value="<?php echo $this->input->post('cur_password');?>"
                                             class="form-control form-control-line" />
                                         <span class="text-danger"><?php echo form_error('cur_password');?></span>
                                     </div>
                                 </div>

                                 <div class="form-group">
                                     <label class="col-md-12">New Password</label>
                                     <div class="col-md-12">
                                         <input type="password" name="new_password"
                                             value="<?php echo $this->input->post('new_password');?>"
                                             class="form-control form-control-line" />
                                         <span class="text-danger"><?php echo form_error('new_password');?></span>
                                     </div>
                                 </div>


                                 <div class="form-group">
                                     <label class="col-md-12">Confirm Password</label>
                                     <div class="col-md-12">
                                         <input type="password" name="confirm_password"
                                             value="<?php echo $this->input->post('confirm_password');?>"
                                             class="form-control form-control-line" />
                                         <span class="text-danger"><?php echo form_error('confirm_password');?></span>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <div class="col-sm-12">
                                         <button class="btn btn-success">Update Profile</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- Column -->
     </div>
     <!-- Row -->
     <!-- ============================================================== -->
     <!-- End PAge Content -->
     <!-- ============================================================== -->

 </div>
 <!-- ============================================================== -->
 <!-- End Container fluid  -->
 <!-- ============================================================== -->