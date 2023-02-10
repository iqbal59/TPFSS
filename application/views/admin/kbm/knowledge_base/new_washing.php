<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
<div class="content">
    <div class="container-fluid">
        <form class="z-form" action="<?php echo base_url( 'admin/kbm/washing/add_washing' ); ?>" method="post"
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
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title">New Washing and Drying</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="form-group">
                                <label for="garment">Garment<span class="required">*</span></label>
                                <select class="form-control select2" multiple="multiple"
                                    data-placeholder="Select Garment" name="garment[]" required>
                                    <option></option>

                                    <?php 
                                
                               
                                if ( ! empty( $garments) ) {
                foreach ( $garments as $garment ) { ?>
                                    <option value="<?php echo html_escape( $garment->id ); ?>">
                                        <?php echo html_escape( $garment->name ); ?></option>



                                    <?php }
              } ?>
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fabric">Fabric<span class="required">*</span></label>
                                    <select class="form-control select2 search-disabled" multiple="multiple" id="fabric"
                                        data-placeholder="Select fabric" name="fabric[]" required>
                                        <option></option>

                                        <?php 
                                
                               
                                if ( ! empty( $fabrics) ) {
                                            foreach ( $fabrics as $fabric ) { ?>
                                        <option value="<?php echo html_escape( $fabric->id ); ?>">
                                            <?php echo html_escape( $fabric->name ); ?></option>



                                        <?php }
              } ?>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group col-md-6">
                                    <label for="embellishment">Embellishment</label>
                                    <select class="form-control select2 search-disabled" id="embellishment"
                                        data-placeholder="Select embellishment" name="embellishment">
                                        <option value="0">No</option>

                                        <?php 
                                
                               
                                if ( ! empty( $embellishments) ) {
                foreach ( $embellishments as $embellishment ) { ?>
                                        <option value="<?php echo html_escape( $embellishment->id ); ?>">
                                            <?php echo html_escape( $embellishment->name ); ?></option>



                                        <?php }
              } ?>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.form-row -->



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="color">Color</label>
                                    <select class="form-control select2 search-disabled" multiple="multiple" id="color"
                                        data-placeholder="Select color" name="color[]">
                                        <option value="0">Any</option>

                                        <?php 
                                
                               
                                if ( ! empty( $colors) ) {
                foreach ( $colors as $color ) { ?>
                                        <option value="<?php echo html_escape( $color->id ); ?>">
                                            <?php echo html_escape( $color->name ); ?></option>



                                        <?php }
              } ?>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group col-md-6">
                                    <label for="water">Water Temperature</label>
                                    <select class="form-control select2 search-disabled" id="water"
                                        data-placeholder="Select water" name="water">
                                        <option value="0">Normal</option>

                                        <?php 
                                
                               
                                if ( ! empty( $waters) ) {
                foreach ( $waters as $water ) { ?>
                                        <option value="<?php echo html_escape( $water->id ); ?>">
                                            <?php echo html_escape( $water->name ); ?></option>



                                        <?php }
              } ?>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.form-row -->



                            <div class="form-group">
                                <label for="special_instruction">Special Instruction<span
                                        class="required">*</span></label>
                                <textarea class="form-control textarea" id="special_instruction"
                                    name="special_instruction"></textarea>
                            </div>



                            <div class="form-group">
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
                                            <th>Dry Program</th>
                                        </tr>
                                        <tr>
                                            <td><input type='checkbox' class='case' /></td>
                                            <td>
                                                <select class="form-control select2 search-disabled"
                                                    data-placeholder="Select Machine"
                                                    onchange="getWashandDryProgram(this.value, '<?php echo base_url('admin/kbm/washing/get_allprogram')?>')"
                                                    id="wash_machine_0" name="wash[0][machine_id]">
                                                    <option value="">--Select--</option>

                                                    <?php 
                                
                                if ( ! empty( $machines) ) {
                foreach ( $machines as $machine ) { 
                    ?>
                                                    <option value="<?php echo html_escape( $machine->id ); ?>">
                                                        <?php echo html_escape( $machine->name ); ?></option>



                                                    <?php }
                                                            } ?>
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

                            </div>




                            <div class="form-group">
                                <label for="textarea">Washing Description</label>
                                <textarea class="form-control textarea" name="content" id="content"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="textarea">Drying Description</label>
                                <textarea class="form-control textarea" name="drying_description"
                                    id="drying_description"></textarea>
                            </div>


                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="meta-keywords"><?php echo lang( 'meta_keywords' ); ?></label>
                                <input type="text" class="form-control" id="meta-keywords" name="meta_keywords">
                            </div>
                            <!-- /.form-group -->
                            <label for="meta-description"><?php echo lang( 'meta_description' ); ?></label>
                            <textarea class="form-control" id="meta-description" name="meta_description"
                                rows="2"></textarea>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang( 'action' ); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-block text-sm">
                                <i class="fas fa-check-circle mr-2"></i> <?php echo lang( 'submit' ); ?>
                            </button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Other Options <span class="required">*</span>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">






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