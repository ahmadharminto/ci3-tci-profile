<?php
    $home_slider = ($home_section_data->home_slider_json) ? json_decode($home_section_data->home_slider_json, TRUE) : []; 
    $slider_image1 = '';
    $slider_text1 = '';
    $slider_image2 = '';
    $slider_text2 = '';
    $slider_image3 = '';
    $slider_text3 = '';
    foreach ($home_slider as $i => $slider) {
        if ($i == 0) {
            $slider_image1 = base_url('public/images/upload/'.$slider['image']);
            $slider_text1 = $slider['txt'];
        } 
        elseif ($i == 1) {
            $slider_image2 = base_url('public/images/upload/'.$slider['image']);
            $slider_text2 = $slider['txt'];
        }
        elseif ($i == 2) {
            $slider_image3 = base_url('public/images/upload/'.$slider['image']);
            $slider_text3 = $slider['txt'];
        }
    }

    $img_about_us = ($home_section_data->about_us_image) ? base_url('public/images/upload/'.$home_section_data->about_us_image) : '';
    $services = ($home_section_data->services_json) ? json_decode($home_section_data->services_json, TRUE) : [];
    $working_areas = ($home_section_data->working_areas_json) ? json_decode($home_section_data->working_areas_json, TRUE) : [];
?>

<!-- Section: home -->
<section id="home" class="divider no-bg fullscreen">
    <div class="home-container mt-0 top-0">
        <div class="home-text">
            <div class="revslider tp-banner" >
                <ul>
                    <!-- SLIDE 1 -->
                    <li data-transition="random" data-slotamount="5" data-masterspeed="300" data-thumb="http://placehold.it/1920x1280" data-saveperformance="off" data-title="Quick Results"> 
                        <img src="<?=$slider_image1;?>" alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 
                        <?=urldecode($slider_text1);?>
                    </li>
                    <!-- SLIDE 2 -->
                    <li data-transition="random" data-slotamount="3" data-masterspeed="300" data-thumb="http://placehold.it/1920x1280" data-saveperformance="off" data-title="Quick Results">
                        <img src="<?=$slider_image2;?>" alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 
                        <?=urldecode($slider_text2);?>                        
                    </li>
                    <!-- SLIDE 3 -->
                    <li data-transition="random" data-slotamount="4" data-masterspeed="300" data-thumb="http://placehold.it/1920x1280" data-saveperformance="off" data-title="Quick Results">
                        <img src="<?=$slider_image3;?>" alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 
                        <?=urldecode($slider_text1);?>
                    </li>
                </ul>
                <div class="tp-bannertimer"></div>
            </div>
        </div>
    </div>
</section>

<!-- Section: About -->
<section id="about" class="section-dark-blue">
    <div class="container">
        <div class="section-title">
            <div class="row">
                <div class="col-md-6">
                    <div class="esc-heading small-border left-heading">
                        <h2><span>Ab</span>out us</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row">
                <div class="col-md-5 text-center"><img src="<?=$img_about_us;?>" alt=""></div>
                <div class="col-md-7 pl-30">
                    <?=urldecode($home_section_data->about_us_text);?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Divider: Funfacts -->
<?php if ($home_section_data->visitor_count_visibility == 1) : ?>
    <section class="divider bg16 parallax layer-overlay overlay-dark">
        <div class="container pt-100 pb-100">
            <div class="row">
                <?php /*
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="funfact"> 
                        <i class="pe-7s-stopwatch text-white"></i>
                        <h2 class="animate-number text-white" data-value="12" data-animation-duration="1500">0</h2>
                        <span>Years of Experience</span> 
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="funfact"> 
                        <i class="pe-7s-portfolio text-white"></i>
                        <h2 class="animate-number text-white" data-value="1430" data-animation-duration="4000">0</h2>
                        <span>Projects Completed</span> 
                    </div>
                </div>
                */ ?>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="funfact"> 
                        <i class="pe-7s-smile text-white"></i>
                        <h2 class="animate-number text-white" data-value="<?php echo ($this->session->userdata('visitor')) ? $this->session->userdata('visitor') : 0; ?>" data-animation-duration="500">0</h2>
                        <span>Visitors</span> 
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Section: Services -->
<section id="services" class="section-dark-blue">
    <div class="container">
        <div class="section-title">
            <div class="row">
                <div class="col-md-6">
                    <div class="esc-heading small-border left-heading">
                        <h2><span>Se</span>rvices</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row multi-row-clearfix">
                <?php foreach ($services as $service) : ?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="icon-box boxed mb-30 <?=$service['style'];?>">
                            <h4 class="heading"><?=$service['title'];?></h4>
                            <p><?=$service['content'];?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Divider: twitter -->
<?php if ($home_section_data->twitter_visibility == 1) : ?>
    <section class="divider bg28 parallax layer-overlay overlay-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fa fa fa-twitter font-48 mb-30 text-white"></i>
                    <div class="twitter-feed twitter-carousel twitter-white text-center"></div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Section: Working Areas -->
<section id="working-areas" class="section-dark-blue">
    <div class="container">
        <div class="section-title">
            <div class="row">
                <div class="col-md-6">
                    <div class="esc-heading small-border left-heading">
                        <h2><span>Wo</span>rking Areas</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row multi-row-clearfix">
                <?php foreach ($working_areas as $working) : ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="icon-box boxed mb-30 <?=$working['style'];?>">
                            <h4 class="heading"><?=$working['title'];?></h4>
                            <p><?=$working['content'];?></p>
                        </div>
                    </div>
                <?php endforeach; ?>              
            </div>
        </div>
    </div>
</section>