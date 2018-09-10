<?php $this->load->view('admin/header',$this->data); ?>

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

    <div class="main-content" >
        <div class="wrap-content container" id="container">
            <!-- start: DASHBOARD TITLE -->
            <section id="page-title" class="padding-top-15 padding-bottom-15">
                <div class="row">
                    <div class="col-sm-7">
                        <h1 class="mainTitle">Dashboard</h1>
                        <span class="mainDescription">Welcome </span>
                    </div>

                </div>
            </section>
            <!-- end: DASHBOARD TITLE -->
        </div>
    </div>
                    
<?php $this->load->view('admin/footer',$this->data); ?>