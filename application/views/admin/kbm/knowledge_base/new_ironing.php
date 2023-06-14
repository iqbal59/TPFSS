<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
<div class="content">
    <div class="container-fluid">
        <form class="z-form" enctype="multipart/form-data" action="<?php echo base_url('admin/knowledge_base/add_ironing'); ?>" method="post"
            data-csrf="manual">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="row">
                <div class="col">
                    <div class="response-message"><?php echo alert_message(); ?></div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title">New Ironing</h3>

                            <div class="card-tools ml-auto">
                                <button type="submit" class="btn btn-primary btn-block text-sm">
                                    <i class="fas fa-check-circle mr-2"></i> <?php echo lang( 'submit' ); ?>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="form-group">
                                <label for="fabric">Fabric<span class="required">*</span></label>
                                <input type="text" class="form-control" name="fabname" placeholder="Enter Fabric" id="fabric" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="heat">Heat Mode<span class="required">*</span></label>
                                    <input type="text" name="htmode" class="form-control" placeholder="Enter Heat Mode" id="heat" required>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group col-md-6">
                                    <label for="steam">Steam<span class="required">*</span></label>
                                    <input type="text" name="steam" class="form-control" placeholder="Steam Ironing" id="steam" required>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.form-row -->



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="oncloth">Cotton Cloth On Fabric<span class="required">*</span></label>
                                    <input type="text" name="ccof" class="form-control" placeholder="Use Cotton Cloth On Fabric Or Not" id="oncloth" required>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group col-md-6">
                                    <label for="inside">Inside Out<span class="required">*</span></label>
                                    <input type="text" name="Inside_out" class="form-control"
                                    placeholder="Ironing On The Inside Of The Cloths" id="inside" required>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.form-row -->


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="water">Water Spray<span class="required">*</span></label>
                                    <input type="text" name="water_spray" class="form-control" placeholder="Use Water Spray Or Not" id="water" required>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group col-md-6">
                                    <label for="starch">Starch Spray<span class="required">*</span></label>
                                    <input type="text" name="starch_spray" class="form-control"
                                    placeholder="Use Starch Spray Or Not" id="starch" required>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.form-row -->


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="hand">Hand Pressure<span class="required">*</span></label>
                                    <input type="text" name="hand_pressure" class="form-control" placeholder="Hand Pressure On Fabric" id="hand" required>
                                </div>
                                <!-- /.form-group -->
                                <!-- <div class="form-group col-md-6">
                                    <label for="fbimg">Upload Fabric Image<span class="required">*</span></label>
                                    <input type="file" name="fab_img" class="form-control"
                                    placeholder="" id="fbimg" required>
                                </div> -->
                                <!-- /.form-group -->
                            </div>
                            <!-- /.form-row -->



                            <!-- <div class="form-group">
                                <label for="special_instruction">Special Instruction<span
                                        class="required">*</span></label>
                                <textarea class="form-control textarea" id="special_instruction"
                                    name="special_instruction"></textarea>
                            </div> -->



                            <!-- <div class="form-group">
                                <label for="">
                                    Washing and Drying Program
                                </label>
                                <div class="table-responsive">
                                    <table
                                        class="custom-table z-table table table-striped text-nowrap table-valign-middle mb-0">
                                        <tr>
                                            <th><input class='check_all' type='checkbox' onclick="select_all()" /></th>
                                            <th>Machine</th>
                                            <th>Wash Program</th>
                                            <th>Wash Chemical</th>
                                            <th>Dry Program</th>
                                        </tr>
                                        <tr>
                                            <td><input type='checkbox' class='case' /></td>
                                            <td>
                                                <select class="form-control select2 search-disabled"
                                                    data-placeholder="Select Machine"
                                                    onchange="getWashandDryProgram(this.value, '<?php// echo base_url('admin/kbm/washing/get_allprogram')?>')"
                                                    id="wash_machine_0" name="wash[0][machine_id]">
                                                    <option value="">--Select--</option>

                                                    <?php 
                                
                               // if ( ! empty( $machines) ) {
                //foreach ( $machines as $machine ) { 
                    ?>
                                                    <option value="<?php// echo html_escape( $machine->id ); ?>">
                                                        <?php// echo html_escape( $machine->name ); ?></option>



                                                    <?php// }
                                                           // } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control select2 search-disabled"
                                                    data-placeholder="Select Wash Program" id="wash_program_0"
                                                    name="wash[0][wash_program_id]">
                                                    <option value="">--Select--</option>
                                                </select>

                                            </td>

                                            <td>
                                                <select class="form-control select2 search-disabled"
                                                    data-placeholder="Select Wash Chemical" id="wash_chemical_0"
                                                    name="wash[0][wash_chemical_ids][]" multiple="multiple">
                                                    <option value="">--Select--</option>

                                                </select>
                                            </td>

                                            <td>
                                                <select class="form-control select2 search-disabled"
                                                    data-placeholder="Select Dry Program" id="dry_program_0"
                                                    name="wash[0][dry_program_id]">
                                                    <option value="">--Select--</option>
                                                </select>
                                            </td>

                                        </tr>
                                    </table>

                                </div>
                                <button type="button" class='btn btn-danger btn-sm delete'>- Delete</button>
                                <button type="button" class='btn btn-primary btn-sm addmore'>+ Add More</button>

                            </div> -->




                            <!-- <div class="form-group">
                                <label for="textarea">Washing Description</label>
                                <textarea class="form-control textarea" name="content" id="content"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="textarea">Drying Description</label>
                                <textarea class="form-control textarea" name="drying_description"
                                    id="drying_description"></textarea>
                            </div> -->

                            <br>
                            <br>
                            <br>

                            <!-- <div class="form-group">
                                <label for="meta-keywords">Video URL</label>
                                <input type="text" class="form-control" id="video_url" name="video_url" value="">
                            </div> -->

                            <!-- /.form-group -->
                            <!-- <div class="form-group">
                                <label for="meta-keywords"><?php// echo lang( 'meta_keywords' ); ?></label>
                                <input type="text" class="form-control" id="meta-keywords" name="meta_keywords">
                            </div> -->
                            <!-- /.form-group -->
                            <!-- <label for="meta-description"><?php// echo lang( 'meta_description' ); ?></label>
                            <textarea class="form-control" id="meta-description" name="meta_description"
                                rows="2"></textarea> -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        </form>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->