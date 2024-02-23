<!-- Content Header (Page header) -->
<div class="container-fluid">

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Store</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">View Store</li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">


            <div class="d-flex m-t-10 justify-content-end">
                <!-- <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                <div class="chart-text m-r-10">
                    <h6 class="m-b-0"><small>Active Store</small></h6>
                    <h4 class="m-t-0 text-info">21</h4>
                </div>
            </div> -->
                <!-- <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                <div class="chart-text m-r-10">
                    <h6 class="m-b-0"><small>Inctive User</small></h6>
                    <h4 class="m-t-0 text-primary"><?php echo $count->inactive_user; ?></h4>
                </div>
            </div> -->

            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- right column -->
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <!-- View New User -->
                            View Store
                            <?php ?>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-12">



                            <div class="panel panel-success">
                                <div style="margin:0;" class="panel-heading h4">
                                    STORE CONTACT DETAILS
                                </div>
                                <div class="panel-boby">
                                    <div class="row" style="padding:5px 15px;">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Partner Name</label>
                                            <input type="text" disabled name="partner_name"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('partner_name', $str->partner_name); ?>">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Partner Mobile No.</label>
                                            <input type="text" disabled name="mobile_no"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('mobile_no', $str->mobile_no); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Partner Email ID</label>
                                            <input type="email" disabled name="email_id"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('email_id', $str->email_id); ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="panel panel-info">
                                <div style="margin:0;" class="panel-heading h4">
                                    STORE DETAILS
                                </div>
                                <div class="panel-boby">
                                    <div class="row" style="padding:5px 15px;">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Store Code</label>
                                            <input type="text" disabled name="store_code"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('store_code', $str->store_code); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">CRM Store Name</label>
                                            <input type="text" disabled name="store_name"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('store_name', $str->store_name); ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="form-label" for="">Store CRM Code</label>
                                            <input type="text" name="store_crm_code" disabled
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('store_crm_code', $str->store_crm_code); ?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="form-label" for="">Is FOFO</label>
                                            <select name="is_fofo" disabled class="form-control form-control-sm"
                                                value="<?php echo set_select('is_fofo', $str->is_fofo); ?>" id="">
                                                <?php if ($str->is_fofo == 1): ?>
                                                <option value="1" selected>Yes</option>
                                                <option value="2">No</option>
                                                <?php else: ?>
                                                <option value="1">Yes</option>
                                                <option value="2" selected>No</option>
                                                <?php endif ?>

                                            </select>

                                        </div>

                                    </div>

                                    <!-- <div class="row" style="padding:0px 15px;">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Opening Balance</label>
                                            <input type="text" name="opening_balance"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('opening_balance'); ?>">
                                        </div>
                                        <div class="form-group col-md-4 mb-3">
                                            <label class="form-label" for="">Courier Charge Per Kg</label>
                                            <input type="text" name="courier_charge_per_kg"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('courier_charge_per_kg'); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Out Of Delivery Charge</label>
                                            <input type="text" name="out_of_delivery_charge"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('out_of_delivery_charge'); ?>">
                                        </div>
                                    </div> -->

                                    <div class="row" style="padding:0px 15px;">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Paytm MID</label>
                                            <input type="text" disabled name="paytm_mid_1"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('paytm_mid_1', $str->paytm_mid_1); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">1st Pickup Slot</label>
                                            <input type="time" disabled name="first_pickup"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('first_pickup', $str->first_pickup); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Last Pickup Slot</label>
                                            <input type="time" disabled name="last_pickup"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('last_pickup', $str->last_pickup); ?>">
                                        </div>
                                    </div>

                                    <div class="row" style="padding:0px 15px;">
                                        <!-- <div class="form-group col-md-4">
                                            <label class="form-label" for="">Launch Date</label>
                                            <input type="date" name="launch_date" class="form-control form-control-sm"
                                                value="<?php echo set_value('launch_date'); ?>">
                                             <?php // echo form_input('launch_date', set_value('launch_date'), 'type="date"'); ?>
                                             <span class="text-danger"><?php echo form_error('launch_date'); ?></span>
                                        </div> -->
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Store Manager Name</label>
                                            <input type="text" disabled name="str_manager_name"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('str_manager_name', $str->str_manager_name); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">TSM Name</label>
                                            <input type="text" disabled name="tsm_name"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('tsm_name', $str->tsm_name); ?>">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Store Address</label>
                                            <input type="text" disabled name="str_address"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('str_address', $str->str_address); ?>">
                                        </div>

                                    </div>

                                    <div class="row" style="padding:0px 15px;">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Store City</label>
                                            <!-- <select name="store_city" id="city" class="form-control form-control-sm">
                                                    <option value="">Select</option>
                                                </select> -->
                                            <input type="text" disabled name="store_city"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('store_city', $str->store_city); ?>">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Store State</label>
                                            <select name="store_state" disabled id="state"
                                                class="form-control form-control-sm" value="">
                                                <?php
                                                // foreach ($outcome1 as $value1) {
                                                //     echo "<option class='' value='$value1->id'>$value1->name</option>";
                                                // }
                                                if (!empty($states)) {
                                                    foreach ($states as $value1) {
                                                        $selected = '';
                                                        if (!empty($str->store_state)) {
                                                            if ($str->store_state == $value1->id) {
                                                                $selected = "selected";
                                                            }
                                                        }

                                                        echo '<option value="' . $value1->id . '" ' . $selected . '>' . $value1->name . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <!-- <input type="text" name="store_state" class="form-control form-control-sm" value=""> -->

                                        </div>


                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Store Pin Code</label>
                                            <input type="text" disabled name="str_pin_code"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('str_pin_code', $str->str_pin_code); ?>">
                                        </div>

                                    </div>

                                    <div class="row" style="padding:0px 15px;">

                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-warning">
                                <div style="margin:0;" class="panel-heading h4">
                                    FIRM DETAILS
                                </div>
                                <div class="panel-boby">

                                    <div class="row" style="padding:5px 15px;">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Firm Name</label>
                                            <input type="text" disabled name="firm_name"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('firm_name', $str->firm_name); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Firm GST Registration Type</label>
                                            <select name="firm_gst_regis_type" disabled
                                                class="form-control form-control-sm"
                                                value="<?php echo set_select('firm_gst_regis_type', $str->firm_gst_regis_type); ?>"
                                                id="">
                                                <?php if ($str->firm_gst_regis_type == 1): ?>
                                                <option value="1" selected>GST</option>
                                                <option value="2">Non GST</option>
                                                <?php else: ?>
                                                <option value="1">GST</option>
                                                <option value="2" selected>Non GST</option>
                                                <?php endif ?>

                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">GST No.</label>
                                            <input type="text" disabled name="gst_no"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('gst_no', $str->gst_no); ?>">
                                        </div>
                                    </div>

                                    <div class="row" style="padding:0px 15px;">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for=""> Firm Pan No.</label>
                                            <input type="text" disabled name="firm_pan_no"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('firm_pan_no', $str->firm_pan_no); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Firm Address</label>
                                            <input type="text" disabled name="firm_address"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('firm_address', $str->firm_address); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Firm City</label>
                                            <!-- <select name="store_city" id="city" class="form-control form-control-sm">
                                                    <option value="">Select</option>
                                                </select> -->
                                            <input type="text" disabled name="firm_city"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('firm_city', $str->firm_city); ?>">
                                        </div>

                                    </div>

                                    <div class="row" style="padding:0px 15px;">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Firm State</label>
                                            <select name="firm_state" disabled id="state"
                                                class="form-control form-control-sm" value="">
                                                <?php
                                                // foreach ($outcome1 as $value1) {
                                                //     echo "<option class='' value='$value1->id'>$value1->name</option>";
                                                // }
                                                if (!empty($states)) {
                                                    foreach ($states as $value1) {
                                                        $selected = '';
                                                        if (!empty($str->firm_state)) {
                                                            if ($str->firm_state == $value1->id) {
                                                                $selected = "selected";
                                                            }
                                                        }

                                                        echo '<option value="' . $value1->id . '" ' . $selected . '>' . $value1->name . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <!-- <input type="text" name="store_state" class="form-control form-control-sm" value=""> -->
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Firm Pin Code</label>
                                            <input type="text" disabled name="firm_pin_code"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('firm_pin_code', $str->firm_pin_code); ?>">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Bank Name </label>
                                            <input type="text" disabled name="bank_name"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('bank_name', $str->bank_name); ?>">
                                        </div>

                                    </div>

                                    <div class="row" style="padding:0px 15px;">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Bank Account Number</label>
                                            <input type="text" disabled name="account_no"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('account_no', $str->account_no); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Bank Branch IFSC Code</label>
                                            <input type="text" disabled name="ifsc_code"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('ifsc_code', $str->ifsc_code); ?>">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Franchise Agreement Date</label>
                                            <input type="date" disabled name="franchise_agreement_date"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('franchise_agreement_date', $str->franchise_agreement_date); ?>">
                                        </div>
                                    </div>

                                    <div class="row" style="padding:0px 15px;">
                                        <div class="form-group col-md-12">
                                            <label class="form-label" style="display:block;" for="">Upload Image of
                                                Cancelled cheque</label>
                                            <!-- <input type="file" name="cancelled_cheque" class="form-control form-control-sm"
                                                value="">
                                            <input type="hidden" name="old" value="<?php echo $str->cancelled_cheque ?>">
                                            <span class="text-danger">
                                                <?php 
                                                 if (isset($error_message)) {
                                                    echo $error_message;
                                                }
                                            ?></span> -->
                                            <div class="col-md-8">
                                                <img style="margin-top:5px;" width="100%"
                                                    src="<?php echo base_url('/assets/uploads/').$str->cancelled_cheque?>"
                                                    alt="">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-warning">
                                <div style="margin:0;" class="panel-heading h4">
                                    MACHINE DETAILS
                                </div>
                                <div class="panel-boby">

                                    <!-- <div class="row" style="padding:5px 15px;">
 
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Machine Name</label>
                                            <select name="machine_name" class="form-control form-control-sm" value="">
                                                <option value="">--Select--</option>
 
                                            </select>
                                            <span class="text-danger"><?php echo form_error('machine_name'); ?></span>
                                        </div>
 
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">Quantity</label>
                                            <input type="text" name="machine_quantity"
                                                class="form-control form-control-sm"
                                                value="<?php echo set_value('machine_quantity'); ?>">
                                            <span
                                                class="text-danger"><?php echo form_error('machine_quantity'); ?></span>
                                        </div>
 
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="">&nbsp;</label>
                                            <button type="button" class="form-control btn btn-primary"><i
                                                    class="fa fa-plus"></i></button>
 
                                        </div>
 
                                    </div> -->

                                    <div class="table-responsive mt-4">

                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <!-- <th scope="col">Sr. No.</th>
                                                    <th scope="col">Machine/Name</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Action</th> -->

                                                    <th class="col-2" scope="col">Sr. No.</th>
                                                    <th class="col-2" scope="col">Model No.</th>
                                                    <th class="col-2" scope="col">Supplier Name</th>
                                                    <th class="col-2" scope="col">Brand Name</th>
                                                    <th class="col-2" scope="col">Machine Type</th>
                                                    <th class="col-2" scope="col">Serial No.</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBody">
                                                <?php
                                                $machineInfo = json_decode($str->machine_info);
                                                $s = 0;
                                                foreach ($machineInfo as $m) {
                                                    // $machines = array('K&B - LG Washer', 'K&B - LG Dryer (E)', 'K&B - LG Dryer (G)', 'Steam Boiler - Trevil Lineblue',
                                                    // 'Steam Boiler - Tumble dry - M&M', 'Tumbledry - Iron Table ', 'Tumbledry - Electrolux - TDWH6-6LAC Washer',
                                                    // 'Tumbledry - Electrolux - TD6-6LAC Dryer', 'Orgaearth - Domus HPW 10', 'Orgaearth - Domus HPD ME',
                                                    // 'Orgaearth - Domus HPD MG', 'Orgaearth - LG Washer ', 'Orgaearth - LG Dryer (E)');

                                                    $models = array("4 PUMP LDRYBL2", "CWG27MD0HS", "CWT29MD0HS", "DLM-18 E", "DLM-23 G ESSENTIAL", "DLS-18 TOUCH II E",
                                                    "DLS-27 TOUCH II E", "Faber 5 - 1230", "FH069FD2FS", "FH069FD2MS", "FTE5ASP303NW10", "HPD-10 ME",
                                                    "HPD-10 MG", "HPW-10 TOUCH II EP", "HYD11-03532-333", "HYD11-03532-443", "LG Dosing Pump",
                                                    "Lineablu - 1560", "MM2SG2", "MM2SG2.1", "PT3JGAJP403UG06", "RN1329AN7S", "RN1840CD7", "RV1329C7T",
                                                    "RV1329CD7P", "RV1840CD7", "SE 4", "SE 8", "STEWYAJP303NW22", "TD6-20LAC / N2360G417", "TD6-37 / N2675G417",
                                                    "TD6-6LAC / N1130E17", "TD-6-7LAC / N1135E17", "USMT001", "VF120", "WF280B", "WH6-6LAC / W555HE17");

                                                    $suppliers = array('Electrolux',
                                                                      'Fabcare',
                                                                      'K&B',
                                                                      'Makers and Merchants',
                                                                      'Orgaearth',
                                                                      'Protek',
                                                                      'QC',
                                                                      'Stefab',
                                                                      'Trevil',
                                                                      'Usmani and co.');

                                                    $brands = array('Alliance',
                                                                    'Brightwell',
                                                                    'Domus',
                                                                    'Dosing Pump - Lagoon',
                                                                    'Electrolux',
                                                                    'Electrolux - Lagoon',
                                                                    'LG',
                                                                    'Local Manufacturer',
                                                                    'M2M',
                                                                    'Stefab',
                                                                    'Trevil',
                                                                    'tumbledry');

                                                    $machines = array('Boiler',
                                                                        'Dosing Pump',
                                                                        'Dryer',
                                                                        'Iron table',
                                                                        'Laundry Stacker',
                                                                        'Softwash Stacker',
                                                                        'Washer');

                                                    ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $s + 1; ?>
                                                    </td>
                                                    <td>


                                                        <select class="form-control"
                                                            name="machine[<?php echo $s; ?>][model]" disabled>
                                                            <option value="">--Select--</option>

                                                            <?php
                                                                foreach ($models as $model) {
                                                                    ?>
                                                            <option value="<?php echo $model ?>"
                                                                <?php echo $m->model === $model ? "selected" : "" ?>>
                                                                <?php echo $model ?>
                                                            </option>
                                                            <?php
                                                                }
                                                                ?>
                                                        </select>

                                                        <?php  //echo $m->name; ?>
                                                    </td>

                                                    <td>


                                                        <select class="form-control"
                                                            name="machine[<?php echo $s; ?>][supplier]" disabled>
                                                            <option value="">--Select--</option>

                                                            <?php
                                                                foreach ($suppliers as $supplier) {
                                                                    ?>
                                                            <option value="<?php echo $supplier ?>"
                                                                <?php echo $m->supplier === $supplier ? "selected" : "" ?>>
                                                                <?php echo $supplier ?>
                                                            </option>
                                                            <?php
                                                                }
                                                                ?>
                                                        </select>

                                                        <?php  //echo $m->name; ?>
                                                    </td>

                                                    <td>


                                                        <select class="form-control"
                                                            name="machine[<?php echo $s; ?>][brand]" disabled>
                                                            <option value="">--Select--</option>

                                                            <?php
                                                                foreach ($brands as $brand) {
                                                                    ?>
                                                            <option value="<?php echo $brand ?>"
                                                                <?php echo $m->brand === $brand ? "selected" : "" ?>>
                                                                <?php echo $brand ?>
                                                            </option>
                                                            <?php
                                                                }
                                                                ?>
                                                        </select>

                                                        <?php  //echo $m->name; ?>
                                                    </td>

                                                    <td>


                                                        <select class="form-control"
                                                            name="machine[<?php echo $s; ?>][machine]" disabled>
                                                            <option value="">--Select--</option>

                                                            <?php
                                                                foreach ($machines as $machine) {
                                                                    ?>
                                                            <option value="<?php echo $machine ?>"
                                                                <?php echo $m->machine === $machine ? "selected" : "" ?>>
                                                                <?php echo $machine ?>
                                                            </option>
                                                            <?php
                                                                }
                                                                ?>
                                                        </select>

                                                        <?php  //echo $m->name; ?>
                                                    </td>

                                                    <td>
                                                        <input type="text" class="form-control"
                                                            name="machine[<?php echo $s; ?>][serial]"
                                                            value="<?php echo $m->serial; ?>" disabled />

                                                    </td>

                                                </tr>
                                                <?php $s++;
                                                } ?>
                                            </tbody>
                                        </table>


                                    </div>
                                    &nbsp;

                                </div>
                            </div>

                            <div class="panel panel-warning">
                                <div style="margin:0;" class="panel-heading h4">
                                    Extra Info
                                </div>
                                <div class="panel-boby">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sr. No.</th>
                                                <th scope="col">Field Name</th>
                                                <th scope="col">Field Value</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $extrainfo = json_decode($str->additional_info);

                                            //print_r($extrainfo);
                                            
                                            for ($i = 0; $i < 10; $i++) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo ($i + 1); ?>
                                                </td>
                                                <td><input type="text" class="form-control"
                                                        name="extrainfo[][field_name]"
                                                        value="<?php echo $extrainfo[$i]->field_name; ?>" disabled></td>
                                                <td><input type=" text" class="form-control"
                                                        name="extrainfo[][field_value]"
                                                        value="<?php echo $extrainfo[$i]->field_value; ?>" disabled>
                                                </td>

                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                        </div>


                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
function addRow() {
    var tableBody = document.getElementById('tableBody');
    var newRow = tableBody.insertRow(tableBody.rows.length);

    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);
    var cell4 = newRow.insertCell(3);

    cell1.innerHTML = tableBody.rows.length; // You can use a counter or any logic for the ID
    cell2.innerHTML = generateSelectBox();
    cell3.innerHTML = '<input type="text" class="form-control" name="machine[][qty]">';
    cell4.innerHTML = '<button class="btn btn-danger" onclick="deleteRow(this)">Delete</button>';
}

function generateSelectBox() {
    // You can customize the options based on your requirements
    var options = ['K&B - LG Washer', 'K&B - LG Dryer (E)', 'K&B - LG Dryer (G)', 'Steam Boiler - Trevil Lineblue',
        'Steam Boiler - Tumble dry - M&M', 'Tumbledry - Iron Table ', 'Tumbledry - Electrolux - TDWH6-6LAC Washer',
        'Tumbledry - Electrolux - TD6-6LAC Dryer', 'Orgaearth - Domus HPW 10', 'Orgaearth - Domus HPD ME',
        'Orgaearth - Domus HPD MG', 'Orgaearth - LG Washer ', 'Orgaearth - LG Dryer (E)'
    ];
    var selectBox = '<select class="form-control" name="machine[][name]">';

    for (var i = 0; i < options.length; i++) {
        selectBox += '<option value="' + options[i] + '">' + options[i] + '</option>';
    }

    selectBox += '</select>';
    return selectBox;
}

function deleteRow(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
</script>