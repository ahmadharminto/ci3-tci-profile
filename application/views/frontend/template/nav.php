<?php
    $company_logo = ($home_section_data->company_logo) ? base_url('public/images/upload/'.$home_section_data->company_logo) : '';
?>

<header class="header">
    <div class="header-nav"> 
        <!-- menu -->
        <nav role="navigation" class="navbar navbar-default navbar-dark navbar-fixed-top navbar-animated navbar-transparent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-header">
                            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            <!-- logo --> 
                            <a id="header-logo" href="<?=base_url();?>" class="navbar-brand"><img src="<?=$company_logo;?>" alt=""></a></div>
                            <!-- end logo -->
                            <div class="navbar-collapse collapse" id="navbar" aria-expanded="false" role="menu" style="height: 1px;">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#home" aria-haspopup="true" role="button" aria-expanded="false">Home</a></li>
                                    <li><a href="#about" aria-haspopup="true" role="button" aria-expanded="false">About</a></li>
                                    <li><a href="#services" aria-haspopup="true" role="button" aria-expanded="false">Services</a></li>
                                    <li><a href="#working-areas" aria-haspopup="true" role="button" aria-expanded="false">Working Areas</a></li>
                                    <li><a href="#footer" aria-haspopup="true" role="button" aria-expanded="false">Contact</a></li>  
                                    <?php /* 
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">Pages <i class="fa fa-angle-down caret"></i></a>
                                        <ul class="dropdown-menu multi-column columns-2">
                                            <li class="col-md-6">
                                                <ul class="multi-column-dropdown">
                                                <li><a href="page-about-us.html">About Us</a></li>
                                                <li><a href="page-about-me.html">About Me</a></li>
                                                <li><a href="page-services1.html">Services 1</a></li>
                                                <li><a href="page-services2.html">Services 2</a></li>
                                                <li><a href="page-team1.html">Team 1</a></li>
                                                <li><a href="page-team2.html">Team 2</a></li>
                                                <li><a href="page-pricing1.html">Pricing 1</a></li>
                                                <li><a href="page-pricing2.html">Pricing 2</a></li>
                                                <li><a href="page-faq1.html">FAQ 1</a></li>
                                                <li><a href="page-faq2.html">FAQ 2</a></li>
                                                <li><a href="page-faq3.html">FAQ 3</a></li>
                                                </ul>
                                            </li>
                                            <li class="col-md-6">
                                                <ul class="multi-column-dropdown">
                                                <li><a href="page-contact1.html">Contact 1</a></li>
                                                <li><a href="page-contact2.html">Contact 2</a></li>
                                                <li><a href="page-login.html">Login</a></li>
                                                <li><a href="page-register.html">Register</a></li>
                                                <li><a href="page-login-register.html">Login/Register</a></li>
                                                <li><a href="page-404-layout1.html">404 Layout 1</a></li>
                                                <li><a href="page-404-layout2.html">404 Layout 2</a></li>
                                                <li><a href="page-404-layout3.html">404 Layout 3</a></li>
                                                <li><a href="page-under-construction.html">Under Construction</a></li>
                                                <li><a href="page-coming-soon.html">Coming Soon</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#" data-toggle="collapse" data-target="#top-search-bar" id="top-search-toggle"><i class="fa fa-search"></i></a></li>
                                    */ ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="top-search-bar" class="collapse">
                        <div class="container">
                            <form role="search" action="#" class="search_form_top" method="get">
                                <input type="text" placeholder="Type text and press Enter..." name="s" class="form-control" autocomplete="off">
                                 <span class="search-close"><i class="fa fa-times"></i></span>
                            </form>
                         </div>
                    </div>
                </div>
            </div>
      </nav>
      <!-- end menu --> 
    </div>
</header>