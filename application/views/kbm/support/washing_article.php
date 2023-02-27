<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>

<?php if ( $article->visibility != 1 ) { ?>
<!-- <div class="alert alert-danger no-radius"><?php echo lang( 'hidden_post' ); ?></div> -->
<?php } ?>



<section class="bg-image position-fixed w-100" style="z-index:1030">
    <div class="container ">
        <div class="row">
            <div class="col-lg-12 m-4 ">
                <h3 class="text-center">Washing & Drying Tutorial</h3>
            </div>
            <div class="col-lg-12 mb-4">
                <div class="content">
                    <form class="row g-3" action="<?php echo base_url( 'knowledge-base/washing-article' ); ?>">
                        <div class="col">

                            <label class="form-label" for="machine_id">Machine<span class="required">*</span></label>
                            <select class="form-control select2 " id="machine_id" data-placeholder="--Select Machine--"
                                name="machine_id" required>
                                <option></option>

                                <?php 
                                        
                                    
                                        if ( ! empty( $machines) ) {
                                foreach ( $machines as $machine ) { ?>
                                <option value="<?php echo html_escape( $machine->id ); ?>"
                                    <?php echo $machineId==$machine->id?"selected":"";?>>
                                    <?php echo html_escape( $machine->name ); ?></option>



                                <?php }
                                } ?>
                            </select>

                        </div>

                        <div class="col">
                            <label class="form-label" for="garment">Garment<span class="required">*</span></label>
                            <select class="form-control border-0 select2 " id="garment"
                                data-placeholder="Select Garment" name="garment" required>
                                <option></option>

                                <?php 
                                        
                                    
                                        if ( ! empty( $garments) ) {
                                foreach ( $garments as $g ) { ?>
                                <option value="<?php echo html_escape( $g->id ); ?>"
                                    <?php echo $garment==$g->id?"selected":"";?>>
                                    <?php echo html_escape( $g->name ); ?></option>



                                <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label" for="fabric">Fabric <span class="required">*</span></label>
                            <select class="form-control select2 " id="fabric" data-placeholder="Select fabric"
                                name="fabric" required>
                                <option></option>

                                <?php 
                                    
                                
                                    if ( ! empty( $fabrics) ) {
                            foreach ( $fabrics as $f ) { ?>
                                <option value="<?php echo html_escape( $f->id ); ?>"
                                    <?php echo $fabric==$f->id?"selected":"";?>>
                                    <?php echo html_escape( $f->name ); ?></option>



                                <?php }
                            } ?>
                            </select>
                        </div>
                        <div class="col"><label class="form-label" for="embellishment">Embellishment</label>
                            <select class="form-control select2 " id="embellishment"
                                data-placeholder="Select embellishment" name="embellishment" required>
                                <option value="0">No</option>

                                <?php 
                                            
                                        
                                            if ( ! empty( $embellishments) ) {
                                    foreach ( $embellishments as $e ) { ?>
                                <option value="<?php echo html_escape( $e->id ); ?>"
                                    <?php echo $embellishment==$e->id?"selected":"";?>>
                                    <?php echo html_escape( $e->name ); ?></option>



                                <?php }
                                    } ?>
                            </select>
                        </div>
                        <div class="col"> <label class="form-label" for="color">Color</label>
                            <select class="form-control select2 " id="color" data-placeholder="Select color"
                                name="color" required>
                                <option value="0">Any</option>

                                <?php 
        
       
                                                    if ( ! empty( $colors) ) {
                                            foreach ( $colors as $c ) { ?>
                                <option value="<?php echo html_escape( $c->id ); ?>"
                                    <?php echo $color==$c->id?"selected":"";?>>

                                    <?php echo html_escape( $c->name ); ?></option>



                                <?php }
                                            } ?>
                            </select>
                        </div>
                        <div class="col mt-4">
                            <br />
                            <button type="submit" class="btn border-0 btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="z-posts container" style="margin-top:180px;">
    <div class="row mb-4">
        <!-- <div class="col">
      <?php load_view( 'home/support/breadcrumb', [
          'name' => $article->category_name,
          'slug' => $article->category_slug,
          'parent_id' => $article->category_parent_id,
          'article_page' => true
       ]); ?>
    </div> -->
        <!-- /col -->
    </div>
    <!-- /.row -->
    <div class="row row-main">




        <div class="col-lg-12 mb-2">

            <?php 
            
           // print_r($article);
            if ( ! empty( $article ) ) {
          $article_url = env_url( get_kb_article_slug( $article->slug ) ); ?>
            <h3 class="fw-bold mb-2"><?php echo html_escape( $article->title ); ?></h3>
            <!-- <span class="d-inline-block small me-2">
                    <i class="far fa-clock"></i>
                    <?php printf( lang( 'posted_on' ), get_date_time_by_timezone( html_escape( $article->created_at ), true ) ); ?>
                </span> -->


            <div class="content border-top margin-footer">

                <h5 class="fw-bold mb-4">Special Instruction</h5>

                <div class="alert alert-danger">
                    <?php echo strip_extra_html( do_secure( $article->special_instruction, true ) ); ?>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-header text-center">Washing</h5>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <h6 class="card-title">Programme Name</h6>
                                        <p class="card-text fw-bold">
                                            <?php echo $washAndDryProgram->wash_program_name; ?>
                                        </p>
                                    </div>
                                    <div class="col">
                                        <h6 class="card-title">Water Temeprature</h6>
                                        <p class="card-text fw-bold">
                                            <?php
                                                if($article->water_id == '2')
                                                echo "Cold";
                                                else if($article->water_id == '3')
                                                echo "Warm";
                                                else
                                                echo "Normal";
                                    
                                    
                                                ?>
                                        </p>
                                    </div>

                                </div>
                                <h6 class="card-title mt-2">Chemical Composition</h6>
                                <table class="table">
                                    <thead>
                                        <tr class="table-light">
                                            <th>Dosing Type</th>
                                            <th>Chemical Name</th>
                                            <th>Dosage</th>
                                            <!-- -ml per kg /(Per Litre Water Handwash ) -->
                                            <th>Wash Load (Kgs)</th>
                                            <th>Total Dosage (ml)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($articleChemical as $c) { ?>
                                        <tr>
                                            <td><?php echo $c->dosing_type;?></td>
                                            <td><?php echo $c->chemical_name;?></td>
                                            <td><?php echo $c->dosage;?></td>
                                            <td><?php echo $c->wash_load;?></td>
                                            <td><?php echo $c->total_dose;?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>

                                <h6 class="card-title">Washing Description</h6>
                                <p><?php echo strip_extra_html( do_secure( $article->content, true ) ); ?></p>

                                <?php if($article->video_url){?>
                                <h6 class="fw-bold mb-2">Video</h6>
                                <div class="content-holder">
                                    <video width="100%" height="340" controls>
                                        <source src="<?php echo $article->video_url;?>" type="video/mp4">

                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <h5 class="card-header text-center">Drying</h5>
                            <div class="card-body">


                                <h6 class="card-title">Drying Programme</h6>

                                <p class="fw-bold">
                                    <?php echo $washAndDryProgram->dry_program_name." (".$washAndDryProgram->dry_time; ?>
                                    Minutes)</p>


                                <h6 class="fw-bold mb-2">Drying Description</h6>
                                <div class="content-holder">
                                    <p><?php echo strip_extra_html( do_secure( $article->drying_description, true ) ); ?>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



















            </div>
            <!-- /.content -->
            <?php } ?>

        </div>
        <!-- /col -->

    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

<?php load_view( 'home/still_no_luck' ); ?>