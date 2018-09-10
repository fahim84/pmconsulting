<?php $this->load->view('admin/header',$this->data); ?>


    <div class="main-content" >
    <div class="wrap-content container" id="container">

    <!-- start: STRIPED ROWS -->
    <div class="container-fluid container-fullw bg-white" style="margin-top: 10px;" >
    <div class="row">
    <div class="col-md-12">

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

        <form name="search_form" id="search_form" class="form-inline" role="form">
            <div class="col-md-3 row">
                <h3 class="pull-left">Articles &nbsp;</h3>
                <h4><div class="label label-warning" align="center"><?php echo $total_rows; ?></div></h4>
            </div>
            <div class="row col-md-6">
                <div class="input-group">
                    <input class="form-control" autocomplete="off" type="text" id="keyword" name="keyword" value="<?php echo $keyword; ?>" placeholder="Search"   />
                    <span class="input-group-btn">
      <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
    </span>
                </div>
            </div>
            <input type="hidden" name="order_by" id="order_by" value="<?php echo $order_by; ?>" >
            <input type="hidden" name="direction" id="direction" value="<?php echo $direction; ?>" >
        </form>
        <a href="<?php echo base_url(); ?>admin/article/update" class="btn btn-wide btn-warning pull-right"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>

        <script>
            $('#order_by, #direction').change(function(e) {
                $('#search_form').submit();
            });
        </script>

        <?php
        if($rows->num_rows())
        {
            ?>
            <table class="table">
                <thead>
                <tr>
                    <th>Article</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($rows->result() as $row)
                {
                    $image_url = $row->image == '' ? base_url().'uploads/articles/placeholder.png' : base_url().'uploads/articles/'.$row->image;
                    $image = base_url()."thumb.php?src=".$image_url."&w=400&h=300";

                    ?>
                    <tr>
                        <td>
                            <h3><?php echo $row->article; ?></h3>
                            <img src="<?php echo $image; ?>" class="img-rounded" alt="image"/>
                            <p><?php echo nl2br($row->description); ?></p>
                        </td>

                        <td>
                            <div class="checkbox">
                                <input id="<?php echo $row->article_id; ?>" value="<?php echo $row->article_id; ?>" type="checkbox" class="js-switch" <?php echo $row->status ? 'checked' : ''; ?> />
                            </div>

                            <a href="<?php echo base_url(); ?>admin/article/update/?id=<?php echo $row->article_id; ?>" class="btn btn-transparent btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="#_" id="<?php echo $row->article_id; ?>" class="btn btn-transparent btn-xs tooltips delete_button" data-toggle="modal" data-target="#DeleteModal" ><i class="fa fa-times fa fa-white"></i> Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <?php echo $pagination_links; ?>
        <?php }else{ ?>
            <br><br><br>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                No record found.
            </div>
        <?php } ?>

    </div>
    </div>
    </div>
        <!-- end: STRIPED ROWS -->

    </div>
    </div>




<div class="modal fade" id="DeleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="<?php echo base_url(); ?>admin/article/delete" method="get" name="delete_model_form" class="form-horizontal" id="delete_model_form" role="form">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger" >Delete</button>
      </div>
      <input type="hidden" name="delete_id" id="delete_id" value="0" >
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$(document).ready(function(){
	
	$('.delete_button').click(function(e) {
		$("#delete_id").val(this.id);
    });
});
function apply_sort(order_by,direction)
{
	$('#order_by').val(order_by);
	$('#direction').val(direction);
	$('#search_form').submit();
}

$(document).on('change','.js-switch',function (e) {

    var id = this.id;
    var status = this.checked ? 1 : 0;
    $.ajax({
        type: "POST",
        url: '<?php echo base_url(); ?>admin/article/change_status',
        data: {'id':id,'status':status},
        dataType: 'html'
    });
});

</script>



<?php $this->load->view('admin/footer',$this->data); ?>