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
        <form action="<?php echo base_url(); ?>admin/icocustom/update" method="post" enctype="multipart/form-data" id="update_form">

            <div class="col-md-6">
                <div class="content-box-large">
                    <fieldset>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Name" required class="form-control" value="<?php echo @$update_data->name; ?>">
                        </div>

                        <div class="form-group">
                            <label>Logo</label>
                            <?php
                            if(@$update_data->image != '')
                            {
                                $image = base_url().'uploads/icos/'.$update_data->image;
                                $image = base_url()."thumb.php?src=".$image."&w=100&h=100";
                                $old_file_html = "<label title=\"Delete $update_data->image\"><input name=\"delete_old_file\" type=\"checkbox\" id=\"delete_old_file\" value=\"1\" /> Delete</label><input name=\"oldfile\" type=\"hidden\" value=\"$update_data->image\" /><br>";
                                ?>
                                <br>
                                <img src="<?php echo $image; ?>" >
                                <?php echo $old_file_html; ?>
                                <?php
                            }
                            ?>
                            <div>
                                <input name="image" type="file" id="image" accept="image/*" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label>URL</label>
                            <input type="url" name="url" placeholder="http://www.xyz.com" required class="form-control" value="<?php echo @$update_data->url; ?>">
                        </div>

                        <div class="form-group">
                            <label>Youtube Video URL</label>
                            <input type="url" name="youtube_url" placeholder="https://www.youtube.com/watch?v=VcEi2HO9whM" class="form-control" value="<?php echo @$update_data->youtube_url; ?>">
                        </div>

                        <div class="form-group">
                            <label>Upload video (mp4 only) and type file name here</label>
                            <?php
                            /*if(@$update_data->video != '')
                            {
                                $video = base_url().'uploads/icos/'.$update_data->video;

                                $old_file_html = "<label title=\"Delete $update_data->video\"><input name=\"delete_old_file2\" type=\"checkbox\" value=\"1\" /> Delete</label><input name=\"oldfile2\" type=\"hidden\" value=\"$update_data->video\" /><br>";
                                */?><!--
                                <br>
                                <video width="100%" controls>
                                    <source src="<?php /*echo $video; */?>" type="video/mp4">
                                    <source src="movie.ogg" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                                <?php /*echo $old_file_html; */?>
                                --><?php
/*                            }*/
                            ?>
                            <div>
                                Example: abc.mp4
                                <!--<input name="video" type="file" id="video" accept="video/mp4" >-->
                                <input name="video" class="form-control" value="<?php echo @$update_data->video; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="desc" rows="3" class="form-control" id="desc" placeholder="Description" required><?php echo @$update_data->desc; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Start Date</label>
                            <input name="start_date" required type="text" value="<?php echo isset($update_data->icoStart) ? date('j M Y',strtotime($update_data->icoStart)) : date('j M Y'); ?>"  class="form-control" id="start_date" placeholder="DD-MM-YYYY" style="cursor:pointer;" readonly >
                        </div>
                        <div class="form-group">
                            <label>Start Time</label>
                            <input name="start_time" required type="text" value="<?php echo isset($update_data->icoStart) ? date('h:i a',strtotime($update_data->icoStart)) : date('h:i a'); ?>" class="form-control" id="start_time" style="cursor:pointer;" readonly>
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
                        <button type="submit" class="btn btn-primary"><?php echo isset($update_data->id) ? 'Update' : 'Add'; ?></button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="content-box-large">
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

                    </fieldset>
                    <div>
                        <button type="submit" class="btn btn-primary"><?php echo isset($update_data->id) ? 'Update' : 'Add'; ?></button>
                    </div>
                </div>
            </div>

            <input name="id" type="hidden" id="id" value="<?php echo isset($update_data->id) ? $update_data->id : 0; ?>">

        </form>

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