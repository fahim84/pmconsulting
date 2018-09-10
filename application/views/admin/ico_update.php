<?php $this->load->view('admin/header',$this->data); ?>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui-timepicker-addon.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-timepicker-addon.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Tokenize-2.5.2/jquery.tokenize.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/Tokenize-2.5.2/jquery.tokenize.css" />


    <div class="main-content" >
    <div class="wrap-content container" id="container">

    <!-- start: STRIPED ROWS -->
    <div class="container-fluid" style="margin-top: 10px;" >
    <div class="row">


<?php if (validation_errors()): ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo validation_errors();?>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['msg_error'])){ ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo display_error(); ?>
    </div>
<?php } ?>

<?php if(isset($_SESSION['msg_success'])){ ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo display_success_message(); ?>
    </div>
<?php } ?>

        <h3><?php echo isset($update_data->id) ? 'Update' : 'Add'; ?> ICO Rating</h3>

        <div class="col-md-6">
            <div class="content-box-large">
        <form action="<?php echo base_url(); ?>admin/ico/update" method="post" enctype="multipart/form-data" id="update_form">
            <fieldset>

                <div class="form-group">
                    <label>Hype Rate</label>
                    <select class="form-control" name="hype_rate" >
                        <option value="">NONE</option>
                        <option value="LOW" <?php echo @$update_data->hype_rate == 'LOW' ? 'selected="selected"' : ''; ?> >LOW</option>
                        <option value="MEDIUM" <?php echo @$update_data->hype_rate == 'MEDIUM' ? 'selected="selected"' : ''; ?> >MEDIUM</option>
                        <option value="HIGH" <?php echo @$update_data->hype_rate == 'HIGH' ? 'selected="selected"' : ''; ?> >HIGH</option>
                        <option value="SUPER" <?php echo @$update_data->hype_rate == 'SUPER' ? 'selected="selected"' : ''; ?> >SUPER</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Risk Rate</label>
                    <select class="form-control" name="risk_rate" >
                        <option value="">NONE</option>
                        <option value="LOW" <?php echo @$update_data->risk_rate == 'LOW' ? 'selected="selected"' : ''; ?> >LOW</option>
                        <option value="MEDIUM" <?php echo @$update_data->risk_rate == 'MEDIUM' ? 'selected="selected"' : ''; ?> >MEDIUM</option>
                        <option value="HIGH" <?php echo @$update_data->risk_rate == 'HIGH' ? 'selected="selected"' : ''; ?> >HIGH</option>
                        <option value="SUPER" <?php echo @$update_data->risk_rate == 'SUPER' ? 'selected="selected"' : ''; ?> >SUPER</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>ROI Rate</label>
                    <select class="form-control" name="roi_rate" >
                        <option value="">NONE</option>
                        <option value="LOW" <?php echo @$update_data->roi_rate == 'LOW' ? 'selected="selected"' : ''; ?> >LOW</option>
                        <option value="MEDIUM" <?php echo @$update_data->roi_rate == 'MEDIUM' ? 'selected="selected"' : ''; ?> >MEDIUM</option>
                        <option value="HIGH" <?php echo @$update_data->roi_rate == 'HIGH' ? 'selected="selected"' : ''; ?> >HIGH</option>
                        <option value="SUPER" <?php echo @$update_data->roi_rate == 'SUPER' ? 'selected="selected"' : ''; ?> >SUPER</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>ICO SOUQ Rate</label>
                    <select class="form-control" name="ico_souq_rate" >
                        <option value="">NONE</option>
                        <option value="LOW" <?php echo @$update_data->ico_souq_rate == 'LOW' ? 'selected="selected"' : ''; ?> >LOW</option>
                        <option value="MEDIUM" <?php echo @$update_data->ico_souq_rate == 'MEDIUM' ? 'selected="selected"' : ''; ?> >MEDIUM</option>
                        <option value="HIGH" <?php echo @$update_data->ico_souq_rate == 'HIGH' ? 'selected="selected"' : ''; ?> >HIGH</option>
                        <option value="SUPER" <?php echo @$update_data->ico_souq_rate == 'SUPER' ? 'selected="selected"' : ''; ?> >SUPER</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>End Date</label>
                    <input name="end_date" required type="text" value="<?php echo isset($update_data->icoEnd) ? date('j M Y',strtotime($update_data->icoEnd)) : date('j M Y'); ?>"  class="form-control" id="end_date" placeholder="DD-MM-YYYY" style="cursor:pointer;" readonly >
                </div>
                <div class="form-group">
                    <label>End Time</label>
                    <input name="end_time" required type="text" value="<?php echo isset($update_data->icoEnd) ? date('h:i a',strtotime($update_data->icoEnd)) : date('h:i a'); ?>" class="form-control" id="end_time" style="cursor:pointer;" readonly>
                </div>


            </fieldset>
            <div>
                <input name="id" type="hidden" id="id" value="<?php echo isset($update_data->id) ? $update_data->id : 0; ?>">
                <button type="submit" class="btn btn-primary"><?php echo isset($update_data->id) ? 'Update' : 'Add'; ?></button>
            </div>
        </form>
    </div>
    </div>

    </div>
    </div>
        <!-- end: STRIPED ROWS -->
        <p>&nbsp;</p>
    </div>
    </div>






<script>
$(document).ready(function(){

    $('#start_date').datepicker({
        dateFormat: 'dd M yy',
        changeYear: true,
        changeMonth: true,
        onSelect: function(selected) {
            $("#end_date").datepicker("option","minDate", selected)
        }
    });
    $('#end_date').datepicker({
        dateFormat: 'dd M yy',
        changeYear: true,
        changeMonth: true,
        onSelect: function(selected) {
            $("#start_date").datepicker("option","maxDate", selected)
        }
    });

    $('#start_time').timepicker({ 'timeFormat': 'hh:mm tt','stepMinute': 5,controlType: 'select',oneLine: true });
    $('#end_time').timepicker({ 'timeFormat': 'hh:mm tt','stepMinute': 5,controlType: 'select',oneLine: true });

});
</script>
<?php $this->load->view('admin/footer',$this->data); ?>