<!-- Container fluid  -->

<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Account Summary</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Account Summary</li>
            </ol>
        </div>

    </div>

    <!-- End Bread crumb and right sidebar toggle -->



    <!-- Start Page Content -->

    <div class="row">
        <div class="col-12">




            <div class="card">

                <div class="card-body">
                    <form method="post" action="<?php echo base_url('partner/summary') ?>" class="form-horizontal"
                        enctype="multipart/form-data" novalidate>


                        <div class="form-body">



                            <div class="row">

                                <div class="col-md-4 offset-xlg-3">
                                    <div class="form-group  m-b-0">

                                        <div class="controls">

                                            <?php
                                            // if (!$month) {
                                            //     echo months(date('n'));
                                            // } else {
                                            //     echo months($month);
                                            // }
                                            
                                            ?>

                                            <select class="form-control form-control-sm selelct2" name="month">
                                                <option value="MONTH" <?php echo $month==1 ? "selected" : ""; ?>>This
                                                    Month</option>
                                                <option value="QUARTER" <?php echo $month==3 ? "selected" : ""; ?>>This
                                                    Quarter</option>
                                                <option value="YEAR" <?php echo $month >3 ? "selected" : ""; ?>>This
                                                    Year</option>

                                                <option value="PYEAR" <?php echo $month > 12 ? "selected" : ""; ?>>Prev
                                                    Year</option>
                                                <!-- <option>All Time</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Year<span class="text-danger">*</span></label>
                                        <div class="controls">


                                            <select name="year" class="form-control select2 form-control-sm">
                                                <?php
                                        for ($i=date('Y'); $i > (date('Y')-3);$i--) {
                                            $selctedY = $year == $i ? 'selected' : '';

                                            echo "<option value='".$i."' ".$selctedY.">".$i."</option>";
                                        }
                                        ?>

                                </select>
                            </div>
                        </div>
                </div> -->
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group m-b-0">

                                        <div class="controls">
                                            <button type="submit" class="btn btn-success btn-sm">Show</button>

                                        </div>
                                    </div>
                                </div>

                            </div>


                            <!-- CSRF token -->
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"
                                value="<?=$this->security->get_csrf_hash();?>" />

                        </div>


                    </form>
                </div>
            </div>


            <div class="card">

                <div class="card-body">


                    <h4 class="card-title">Account Summary for <?php ?>
                    </h4>


                    <div class="table-responsive">
                        <table id="" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Revenue</th>
                                    <th>Total Expense</th>
                                    <th>Consumable</th>
                                    <th>Royalty</th>
                                    <th>Credit</th>
                                    <th>Debit</th>


                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($expense as $e) { ?>
                                <tr>
                                    <td><?php echo $e['m'];?>
                                    <td><?php echo $e['totalsales'];?>
                                    </td>
                                    <td><?php echo($e['msales']+$e['rsales']);?>
                                    </td>
                                    <td><?php echo $e['msales'];?>
                                    </td>
                                    <td><?php echo $e['rsales'];?>
                                    </td>
                                    <td><?php echo $e['credit'];?>
                                    </td>
                                    <td><?php echo $e['debit'];?>
                                    </td>


                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- End Page Content -->

</div>