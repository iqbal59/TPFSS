<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
<div class="content">
    <div class="container-fluid">
        <form class="z-form" action="<?php echo base_url( 'admin/kbm/washing/update_washing' ); ?>" method="post"
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
                            <h3 class="card-title">Edit Washing and Drying</h3>

                            <div class="card-tools ml-auto">

                            </div>
                            <!-- /.card-tools -->
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
                foreach ( $garments as $garment ) { 
                    
                        $garmentIds=explode(",", $article->garment_id);
                    ?>
                                    <option value="<?php echo html_escape( $garment->id ); ?>"
                                        <?php if(in_array($garment->id, $garmentIds)){echo "selected";} ?>>
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
                                            foreach ( $fabrics as $fabric ) { 
                                                $fabricIds=explode(",", $article->fabric_id);
                                                ?>
                                        <option value="<?php echo html_escape( $fabric->id ); ?>"
                                            <?php if(in_array($fabric->id, $fabricIds)){echo "selected";} ?>>
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
                                        <option value="<?php echo html_escape( $embellishment->id ); ?>"
                                            <?php if($embellishment->id == $article->embellishment_id){echo "selected";} ?>>
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
                foreach ( $colors as $color ) { 
                    
                    $colorIds=explode(",", $article->color_id); ?>
                                        <option value="<?php echo html_escape( $color->id ); ?>"
                                            <?php if(in_array($color->id, $colorIds)){echo "selected";} ?>>
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
                                        <option value="<?php echo html_escape( $water->id ); ?>"
                                            <?php if($water->id == $article->water_id){echo "selected";} ?>>
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
                                    name="special_instruction"><?php echo html_escape( do_secure( $article->special_instruction, true ) ); ?></textarea>
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
                                        <?php 
                                      
                                        $i=0;
                                        foreach($articleMachine as $am){
                                      
                                        ?>

                                        <tr>
                                            <td><input type='checkbox' class='case' /></td>
                                            <td>
                                                <select class="form-control select2 search-disabled"
                                                    data-placeholder="Select Machine"
                                                    onchange="getWashandDryProgram(this.value, '<?php echo base_url('admin/kbm/washing/get_allprogram')?>')"
                                                    id="wash_machine_<?php echo $i;?>"
                                                    name="wash[<?php echo $i;?>][machine_id]">
                                                    <option value="">--Select--</option>

                                                    <?php 
                                
                                if ( ! empty( $machines) ) {
                foreach ( $machines as $machine ) { 
                    ?>
                                                    <option value="<?php echo html_escape( $machine->id ); ?>"
                                                        <?php if($machine->id == $am->machine_id){echo "selected";} ?>>
                                                        <?php echo html_escape( $machine->name ); ?></option>



                                                    <?php }
                                                            } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control select2 search-disabled"
                                                    data-placeholder="Select Wash Program"
                                                    id="wash_program_<?php echo $i;?>"
                                                    name="wash[<?php echo $i;?>][wash_program_id]">
                                                    <option value="">--Select--</option>
                                                    <?php
                                                    $washprograms=$this->db->query("select * from tbl_wash_program where machine_id='".$am->machine_id."'")->result();
                                                    foreach($washprograms as $wp){
                                                    ?>

                                                    <option value="<?php echo html_escape( $wp->id ); ?>"
                                                        <?php if($wp->id == $am->wash_program_id){echo "selected";} ?>>
                                                        <?php echo html_escape( $wp->wash_program_name ); ?></option>

                                                    <?php }?>
                                                </select>

                                            </td>
                                            <td>
                                                <select class="form-control select2 search-disabled"
                                                    data-placeholder="Select Dry Program"
                                                    id="dry_program_<?php echo $i;?>"
                                                    name="wash[<?php echo $i;?>][dry_program_id]">
                                                    <option value="">--Select--</option>
                                                    <?php
                                                    $dprograms=$this->db->query("select * from tbl_drying_program where machine_id='".$am->machine_id."'")->result();
                                                    foreach($dprograms as $dp){
                                                    ?>

                                                    <option value="<?php echo html_escape( $dp->id ); ?>"
                                                        <?php if($dp->id == $am->dry_program_id){echo "selected";} ?>>
                                                        <?php echo html_escape( $dp->dry_program_name. " (". $dp->dry_time.")" ); ?>
                                                    </option>

                                                    <?php }?>
                                                </select>
                                            </td>

                                        </tr>

                                        <?php $i++;}?>

                                    </table>

                                </div>
                                <button type="button" class='btn btn-danger btn-sm delete'>- Delete</button>
                                <button type="button" class='btn btn-primary btn-sm addmore'>+ Add More</button>

                            </div>





                            <!-- /.form-row -->
                            <div class="form-group">
                                <label for="textarea">Washing Description<span class="required">*</span></label>
                                <textarea class="form-control textarea" id="textarea"
                                    name="content"><?php echo html_escape( do_secure( $article->content, true ) ); ?></textarea>
                            </div>



                            <div class="form-group">
                                <label for="textarea">Drying Description</label>
                                <textarea class="form-control textarea" name="drying_description"
                                    id="drying_description"><?php echo html_escape( do_secure( $article->drying_description, true ) ); ?></textarea>
                            </div>

                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="meta-keywords"><?php echo lang( 'meta_keywords' ); ?></label>
                                <input type="text" class="form-control" id="meta-keywords" name="meta_keywords"
                                    value="<?php echo html_escape( $article->meta_keywords ); ?>">
                            </div>
                            <!-- /.form-group -->
                            <label for="meta-description"><?php echo lang( 'meta_description' ); ?></label>
                            <textarea class="form-control" id="meta-description" name="meta_description"
                                rows="2"><?php echo html_escape( $article->meta_description ); ?></textarea>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-xl-3">
                    <div class="card collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang( 'article_statistics' ); ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <span>
                                        <strong><?php echo lang( 'helpful' ); ?>:</strong>
                                        <?php echo html_escape( $article->helpful ); ?>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <span>
                                        <strong><?php echo lang( 'not_helpful' ); ?>:</strong>
                                        <?php echo html_escape( $article->not_helpful ); ?>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <span>
                                        <strong><?php echo lang( 'views' ); ?>:</strong>
                                        <?php echo html_escape( $article->views ); ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang( 'action' ); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-block text-sm">
                                <i class="fas fa-check-circle mr-2"></i> <?php echo lang( 'update' ); ?>
                            </button>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <input type="hidden" name="id" value="<?php echo html_escape( $article->id ); ?>">
        </form>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->