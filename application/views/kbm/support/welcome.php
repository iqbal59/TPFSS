<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="response-message no-radius no-mb">
    <?php echo alert_message(); ?>
</div>

<!-- Hero: -->

<!-- /.z-hero-wrapper -->

<!-- Articles: -->
<section class="bg-section1 p-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center section-title">Knowledge Base</h4>
            </div>
        </div>
    </div>
</section>
<?php if (!empty($categories = get_articles_categories())) { ?>

<div class="z-posts container">

    <div class="row">

        <div class="col-md-4  mb-3">
            <a href="<?php echo base_url('knowledge-base/washing-article'); ?>">
                <div class="card rounded-0">
                    <img src="<?php echo base_url('assets/images/home_dry_clean.jpg') ?>" class="card-img-top rounded-0"
                        alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="<?php echo base_url('knowledge-base/washing-article'); ?>">Washing and Drying</a>
                        </h5>
                    </div>
                </div>

            </a>

        </div>


        <div class="col-md-4  mb-3">
            <a href="<?php echo base_url('knowledge-base/stain-article'); ?>">
                <div class="card rounded-0">
                    <img src="<?php echo base_url('assets/images/stain.jpg') ?>" class="card-img-top rounded-0"
                        alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="<?php echo base_url('knowledge-base/stain-article'); ?>">Stain</a>
                        </h5>
                    </div>
                </div>

            </a>

        </div>




        <div class="col-md-4  mb-3">
            <a href="<?php echo base_url('knowledge-base/starching-article'); ?>">
                <div class="card rounded-0">
                    <img src="<?php echo base_url('assets/images/starching.png') ?>" class="card-img-top rounded-0"
                        alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="<?php echo base_url('knowledge-base/starching-article'); ?>">Starching</a>
                        </h5>
                    </div>
                </div>

            </a>

        </div>
        <!-- /col -->
        <?php foreach ($categories as $category) { ?>
        <!-- <div class="col-md-4  mb-3">

            <div class="card rounded-0">
                <img src="<?php echo base_url('assets/images/home_laundry.jpg') ?>" class="card-img-top rounded-0"
                    alt="...">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <a
                            href="<?php echo env_url(get_kb_category_slug(html_escape($category->slug))); ?>"><?php echo html_escape($category->name); ?></a>
                    </h5>
                </div>
            </div>



        </div> -->
        <!-- /col -->

        <?php } ?>
    </div>
    <!-- /.row -->

    <div class="row mb-5">
        <div class="col-md-4  mb-3">
            <a href="<?php echo base_url('knowledge-base/newironing-article'); ?>">
                <div class="card rounded-0">
                    <img src="<?php echo base_url('assets/images/home_laundry.jpg') ?>" class="card-img-top rounded-0"
                        alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="<?php echo base_url('knowledge-base/newironing-article'); ?>">Ironing</a>
                        </h5>
                    </div>
                </div>

            </a>

        </div>
    </div>

</div>
<!-- /.container -->
<?php
} else { ?>
<div class="z-list container my-5">
    <div class="shadow-sm">
        <div class="row">
            <div class="col">
                <div class="list-item">
                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                <img class="not-found mt-2 mb-4" src="<?php illustration_by_color('not_found'); ?>"
                                    alt="">
                                <h2 class="h4 fw-bold">
                                    <?php echo lang('no_records_found'); ?>
                                </h2>
                            </div>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.list-item -->
            </div>
            <!-- /col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.shadow-sm -->
</div>
<!-- /.z-list -->
<?php } ?>

<?php load_view('home/still_no_luck'); ?>