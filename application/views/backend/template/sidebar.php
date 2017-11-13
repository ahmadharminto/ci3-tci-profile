<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class="<?php if ($this->load->get_var('page_type') == 'home_section') echo 'active'; ?>"><a href="<?=base_url('/tci-admin/home');?>"><i class="icon-home4"></i> <span>Home Section</span></a></li>
                    <li>
                        <a href="#"><i class="icon-cogs"></i> <span>Config</span></a>
                        <ul>
                            <li class="<?php if ($this->load->get_var('page_type') == 'config_user') echo 'active'; ?>"><a href="<?=base_url('/tci-admin/user');?>">Users</a></li>
                        </ul>
                    </li>                    
                    <!-- /main -->

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->