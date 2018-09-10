<?php $this->load->view('admin/header',$this->data); ?>

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

        <h3><?php echo isset($update_data->article_id) ? 'Update' : 'Add'; ?> Article</h3>

        <div class="col-md-6">
            <div class="content-box-large">
        <form action="<?php echo base_url(); ?>admin/article/update" method="post" enctype="multipart/form-data" id="update_form">
            <fieldset>
                <div class="form-group">
                    <label>Article Name</label>
                    <input name="article" type="text" required  class="form-control" id="article" placeholder="Article" value="<?php echo @$update_data->article; ?>">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea required name="description" rows="3" class="form-control" id="description" placeholder="Description"><?php echo @$update_data->description; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select required class="form-control" name="status">
                        <option value="1" <?php echo @$update_data->status == '1' ? 'selected="selected"' : ''; ?> >Active</option>
                        <option value="0" <?php echo @$update_data->status == '0' ? 'selected="selected"' : ''; ?> >Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Date</label>
                    <input name="post_date" type="text" class="form-control" id="post_date" placeholder="DD-MM-YYYY" style="cursor:pointer;" readonly value="<?php echo @$update_data->post_date ? date('j M Y',strtotime(@$update_data->post_date)): ''; ?>">
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <?php
                    if(@$update_data->image != '')
                    {
                        $image = base_url().'uploads/articles/'.$update_data->image;
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
                        <input <?php echo isset($update_data->article_id) ? '' : 'required'; ?> name="image" type="file" id="image" accept="image/*">
                    </div>
                </div>

            </fieldset>
            <div>
                <input name="id" type="hidden" id="id" value="<?php echo isset($update_data->article_id) ? $update_data->article_id : 0; ?>">
                <button type="submit" class="btn btn-primary"><?php echo isset($update_data->article_id) ? 'Update' : 'Add'; ?></button>
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

    $('#post_date').datepicker({
        dateFormat: 'dd M yy',
        changeYear: true,
        changeMonth: true
    });

});
</script>
<?php $this->load->view('admin/footer',$this->data); ?>