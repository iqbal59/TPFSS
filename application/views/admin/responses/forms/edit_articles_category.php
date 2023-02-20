<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
<form class="z-form" action="<?php echo base_url( 'admin/kbm/support/update_articles_category' ); ?>" method="post">
    <div class="modal-header">
        <h5 class="modal-title"><?php echo lang( 'edit_category' ); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- /.modal-header -->
    <div class="modal-body">
        <div class="response-message"></div>
        <div class="form-row">
            <div class="col-md-6 form-group">
                <label for="category-edit"><?php echo lang( 'category' ); ?> <span class="required">*</span></label>
                <input type="text" class="form-control" id="category-edit" name="category"
                    value="<?php echo html_escape( $name ); ?>" required>
            </div>
            <!-- /.col -->
            <div class="col-md-6 form-group">
                <label for="slug-edit">
                    <?php echo lang( 'slug' ); ?>
                    <i class="fas fa-info-circle text-sm" data-toggle="tooltip"
                        title="<?php echo lang( 'slug_tip' ); ?>"></i>
                </label>
                <input type="text" class="form-control" id="slug-edit" name="slug"
                    value="<?php echo html_escape( $slug ); ?>">
            </div>
            <!-- /.col -->
        </div>
        <!-- /.form-row -->
        <div class="form-group">
            <label for="meta-keywords-edit"><?php echo lang( 'meta_keywords' ); ?></label>
            <input type="text" class="form-control" id="meta-keywords-edit" name="meta_keywords"
                value="<?php echo html_escape( $meta_keywords ); ?>">
        </div>
        <!-- /.form-group -->
        <label for="meta-description-edit"><?php echo lang( 'meta_description' ); ?></label>
        <textarea class="form-control" id="meta-description-edit" name="meta_description"
            rows="4"><?php echo html_escape( $meta_description ); ?></textarea>
    </div>
    <!-- /.modal-body -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary text-sm" data-dismiss="modal">
            <i class="fas fa-times-circle mr-2"></i> <?php echo lang( 'close' ); ?>
        </button>
        <button type="submit" class="btn btn-primary text-sm">
            <i class="fas fa-check-circle mr-2"></i> <?php echo lang( 'update' ); ?>
        </button>
    </div>
    <!-- /.modal-footer -->

    <input type="hidden" name="id" value="<?php echo html_escape( $id ); ?>">
</form>