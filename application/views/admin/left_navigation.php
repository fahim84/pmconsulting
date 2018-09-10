<!-- sidebar -->
<div class="sidebar app-aside" id="sidebar">
    <div class="sidebar-container perfect-scrollbar">
        <nav>

            <ul class="main-navigation-menu">
                <?php $active_class = $selected_page == 'home' ? 'active open' : ''; ?>
                <li class="<?php echo $active_class; ?>">
                    <a href="<?php echo base_url(); ?>admin/welcome/">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-home"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> Dashboard </span>
                            </div>
                        </div>
                    </a>
                </li>

                <?php $active_class = $selected_page == 'user' ? 'active open' : ''; ?>
                <li class="<?php echo $active_class; ?>">
                    <a href="<?php echo base_url(); ?>admin/user/">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-user"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> Users </span>
                            </div>
                        </div>
                    </a>
                </li>

                <?php $active_class = $selected_page == 'ico' ? 'active open' : ''; ?>
                <li class="<?php echo $active_class; ?>">
                    <a href="<?php echo base_url(); ?>admin/ico/">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-layout-tab"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> ICO's </span>
                            </div>
                        </div>
                    </a>
                </li>

                <?php $active_class = $selected_page == 'icocustom' ? 'active open' : ''; ?>
                <li class="<?php echo $active_class; ?>">
                    <a href="<?php echo base_url(); ?>admin/icocustom/">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-layout-tab"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> Custom ICO's </span>
                            </div>
                        </div>
                    </a>
                </li>

                <?php $active_class = $selected_page == 'article' ? 'active open' : ''; ?>
                <li class="<?php echo $active_class; ?>">
                    <a href="<?php echo base_url(); ?>admin/article/">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-layout-tab"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> NEWS </span>
                            </div>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url(); ?>admin/login/logout">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-power-off"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> Log out [<?php echo $_SESSION['user']->firstname; ?>] </span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- end: MAIN NAVIGATION MENU -->
        </nav>
    </div>
</div>
<!-- / sidebar -->