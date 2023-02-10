<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
<div class="z-align-middle ">
    <div class="card z-card-mini-box form-based">
        <div class="card-body shadow-sm p-0">
            <div class="card-padding">
                <form class="z-form" action="<?php echo env_url( 'admin/kbm/dashboard/dologin' ); ?>" method="post"
                    data-csrf="manual">
                    <div class="response-message"><?php echo alert_message(); ?></div>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="user_name" placeholder="Email address" required>
                    </div>
                    <!-- /.mb-3 -->
                    <div class="mb-2">
                        <input type="password" class="form-control" name="password"
                            placeholder="<?php echo lang( 'password' ); ?>" required>
                    </div>
                    <!-- /.mb-2 -->

                    <div class="d-grid">
                        <button class="btn btn-sub" type="submit"><?php echo lang( 'login' ); ?></button>
                    </div>
                    <!-- /.d-grid -->



                </form>
            </div>
            <!-- /.card-padding -->
        </div>
        <!-- /.card-body -->


    </div>
    <!-- /.card -->
</div>
<!-- /.z-align-middle -->