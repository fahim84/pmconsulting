
        </div>
        <!-- start: FOOTER -->
        <footer>
            <div class="footer-inner">
                <div class="pull-left">
                    &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> <?php echo SYSTEM_NAME; ?></span>. <span>All rights reserved</span>
                </div>
                <div class="pull-right">
                    <span class="go-top"><i class="ti-angle-up"></i></span>
                </div>
            </div>
        </footer>
        <!-- end: FOOTER -->

        </div>




        <script>
            jQuery(document).ready(function() {

                $('form').submit(function() {
                    $(this).find("button[type='submit']").prop('disabled',true);
                    $(this).find("button[type='file']").prop('disabled',true);
                });
                window.setTimeout(function() {
                    $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove();
                    });
                }, 3000);

            });


            <?php if( isset($_SESSION['user']->remember_me) ){ ?>
            <?php if( $_SESSION['user']->remember_me == 1 ){ ?>
            // Store remember me
            localStorage.setItem("user_id", <?php echo $_SESSION['user']->user_id; ?>);
            <?php }else{ ?>
            // remove remember me
            localStorage.removeItem("user_id");
            <?php } ?>
            <?php unset($_SESSION['user']->remember_me); } ?>

        </script>
        <!-- end: JavaScript Event Handlers for this page -->
        <!-- end: CLIP-TWO JAVASCRIPTS -->
        </body>
        </html>
