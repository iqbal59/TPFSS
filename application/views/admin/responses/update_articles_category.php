<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
<td><?php echo html_escape( $id ); ?></td>
<td>
    <?php echo html_escape( $name ); ?>
    <span class="text-muted text-sm d-block"><?php echo '/' . html_escape( get_kb_category_slug( $slug ) ); ?></span>
</td>
<td class="text-right"><?php echo get_date_time_by_timezone( html_escape( $updated_at ) ); ?></td>
<td class="text-right"><?php echo get_date_time_by_timezone( html_escape( $created_at ) ); ?></td>
<td class="text-right">
    <div class="btn-group">
        <a href="<?php echo env_url( html_escape( get_kb_category_slug( $slug ) ) ); ?>" class="btn btn-sm btn-info"
            target="_blank">
            <span class="fas fa-eye"></span>
        </a>
        <button class="btn btn-sm btn-primary get-data-tool"
            data-source="<?php echo base_url( 'admin/kbm/support/edit_articles_category' ); ?>"
            data-id="<?php echo html_escape( $id ); ?>">
            <span class="fas fa-edit get-data-tool-c"></span>
        </button>
        <button class="btn btn-sm btn-danger tool" data-id="<?php echo html_escape( $id ); ?>" data-toggle="modal"
            data-target="#delete">
            <i class="fas fa-trash tool-c"></i>
        </button>
    </div>
    <!-- /.btn-group -->
</td>