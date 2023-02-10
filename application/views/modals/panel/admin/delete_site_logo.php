<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
<!-- Delete Modal: -->
<div class="modal" id="delete-site-logo">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <form class="z-form" action="<?php admin_action( 'settings/delete_site_logo' ); ?>" method="post">
        <div class="modal-body">
          <div class="response-message"></div>
          <p><?php echo lang( 'sure_delete_logo' ); ?></p>
        </div>
        <!-- /.modal-body -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary text-sm" data-dismiss="modal">
            <i class="fas fa-times-circle mr-2"></i> <?php echo lang( 'no' ); ?>
          </button>
          <button type="submit" class="btn btn-danger text-sm">
            <i class="fas fa-check-circle mr-2"></i> <?php echo lang( 'yes' ); ?>
          </button>
        </div>
        <!-- /.modal-footer -->
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->