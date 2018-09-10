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
                    <h3><?php echo isset($update_data->user_id) ? 'Update' : 'Add'; ?> User</h3>
                    <form action="<?php echo base_url(); ?>admin/user/update" method="post" enctype="multipart/form-data" id="update_form">
                        <div class="col-md-6">
                            <div class="content-box-large">




                                <fieldset>
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input name="firstname" type="text" required  class="form-control" id="firstname" placeholder="First Name" value="<?php echo @$update_data->firstname; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Last Name" value="<?php echo @$update_data->lastname; ?>">
                                    </div>


                                    <div class="form-group">
                                        <label>Date of birth</label>
                                        <input name="dob" type="text" class="form-control datepicker" id="dob" placeholder="Date of birth DD-MM-YYYY" style="cursor:pointer;" readonly value="<?php echo @$update_data->dob; ?>">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <label class=" radio-inline"><input type="radio" name="gender" id="male" value="male" <?php echo @$update_data->gender == 'male' ? 'checked' : ''; ?> >Male</label>
                                            <label class=" radio-inline"><input type="radio" name="gender" id="female" value="female" <?php echo @$update_data->gender == 'female' ? 'checked' : ''; ?> >Female</label>
                                        </div>
                                    </div>
                                    <div class="row">&nbsp;</div>
                                    <div class="row">&nbsp;</div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="email" class="form-control" id="email" placeholder="Email" style="text-transform:none;" value="<?php echo @$update_data->email; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="password" type="password" class="form-control" id="password" placeholder="<?php echo isset($update_data->user_id) ? 'Leave Blank, if don\'t want to change' : 'Password'; ?>" >
                                    </div>



                                </fieldset>
                                <div>
                                    <input name="id" type="hidden" id="id" value="<?php echo isset($update_data->user_id) ? $update_data->user_id : 0; ?>">
                                    <button type="submit" id="submit1" class="btn btn-primary"><?php echo isset($update_data->user_id) ? 'Update' : 'Add'; ?></button>
                                </div>


                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="content-box-large">

                                <fieldset>

                                    <div class="form-group">
                                        <label class="col-md-2">Roles</label>
                                        <div class="col-md-4">
                                            <?php
                                            if( array_key_exists(1,$_SESSION['user']->rights) )
                                            { ?>
                                                <label class="checkbox"><input name="roles[]" type="checkbox" value="1" <?php echo (isset($update_data) and  array_key_exists(1,$update_data->roles)) ? 'checked="checked"' : ''; ?> >Super Admin</label>
                                                <?php
                                            } ?>

                                            <label class="checkbox"><input name="roles[]" type="checkbox" value="2" <?php echo (isset($update_data) and  array_key_exists(2,$update_data->roles)) ? 'checked="checked"' : ''; ?> >Admin</label>
                                            <label class="checkbox"><input name="roles[]" type="checkbox" value="3" <?php echo (isset($update_data) and  array_key_exists(3,$update_data->roles)) ? 'checked="checked"' : ''; ?> >Manager</label>
                                            <label class="checkbox"><input name="roles[]" type="checkbox" value="4" <?php echo (isset($update_data) and  array_key_exists(4,$update_data->roles)) ? 'checked="checked"' : ''; ?> >Teamlead</label>

                                        </div>
                                    </div>

                                    <div class="row"><br><br></div>
                                    <div class="form-group">
                                        <label>Rights</label>

                                        <select name="rights[]" multiple="MULTIPLE" class="form-control" id="rights">
                                            <?php
                                            if(isset($update_data->user_id))
                                            {
                                                $user_rights = $this->user_model->get_user_special_rights(@$update_data->user_id);
                                                $rights = $this->user_model->get_rights();
                                                foreach($rights->result() as $row)
                                                {
                                                    ?>
                                                    <option value="<?php echo $row->right_id; ?>" <?php echo @array_key_exists($row->right_id,$user_rights) ? 'selected="selected"' : ''; ?> ><?php echo $row->right; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>About</label>
                                        <textarea name="about" rows="3" class="form-control" id="about" placeholder="About"><?php echo @$update_data->about; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Image</label>
                                        <?php
                                        if(@$update_data->image != '')
                                        {
                                            $image = base_url().'uploads/users/'.$update_data->image;
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


                                            <input name="image" type="file" id="image" accept="image/*">

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="is_activated">
                                            <option value="1" <?php echo @$update_data->is_activated == '1' ? 'selected="selected"' : ''; ?> >Active</option>
                                            <option value="0" <?php echo @$update_data->is_activated == '0' ? 'selected="selected"' : ''; ?> >Inactive</option>
                                        </select>
                                    </div>
                                </fieldset>
                                <div>
                                    <button type="submit" id="submit2" class="btn btn-primary"><?php echo isset($update_data->user_id) ? 'Update' : 'Add'; ?></button>
                                </div>


                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- end: STRIPED ROWS -->
            <p>&nbsp;</p>
        </div>
    </div>


    <script>
$(document).ready(function(){

    $('#rights').tokenize({
        datas: "<?php echo base_url(); ?>admin/user/search_rights/",
        searchParam: 'keyword',
        displayDropdownOnFocus: true,
        placeholder: 'Start typing for adding rights',
        //maxElements: 1,
        newElements: false
    });

    $('.datepicker').datepicker({
        dateFormat: 'dd-mm-yy',

        changeYear: true,
        changeMonth: true
    });

});
</script>


<?php $this->load->view('admin/footer',$this->data); ?>