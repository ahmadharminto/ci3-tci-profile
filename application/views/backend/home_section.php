<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><span class="text-semibold">Home Section</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li class="active"><i class="icon-home2 position-left"></i> Home Section</li>
        </ul>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <input id="id_home_section" type="hidden" value="<?=$home_section_data->id;?>">
    <div class="row">
        <div class="col-md-12">
            <div id="flash_message"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Company Info</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <?php
                        $company_address = ($home_section_data->company_address_json) ? json_decode($home_section_data->company_address_json, TRUE) : [];
                        $company_contact_email = isset($company_address['company_contact_email']) ? $company_address['company_contact_email'] : '';
                        $company_contact_phone = isset($company_address['company_contact_phone']) ? $company_address['company_contact_phone'] : '';
                        $company_address1 = isset($company_address['company_address1']) ? $company_address['company_address1'] : '';
                        $company_address2 = isset($company_address['company_address2']) ? $company_address['company_address2'] : '';
                    ?>
                    <div class="form-group">
                        <label>Web Title</label>
                        <input type="text" class="form-control company-info" data-name="web_title" data-is_summernote="false" value="<?=$home_section_data->title;?>">
                    </div>
                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" class="form-control company-info" data-name="company_name" data-is_summernote="false" value="<?=$home_section_data->company_name;?>">
                    </div>
                    <div class="form-group">
                        <label>Company Contact Email (; separated)</label>
                        <input type="text" class="form-control company-info" data-name="company_contact_email" data-is_summernote="false" value="<?=$company_contact_email;?>">
                    </div>
                    <div class="form-group">
                        <label>Company Contact Phone (; separated)</label>
                        <input type="text" class="form-control company-info" data-name="company_contact_phone" data-is_summernote="false" value="<?=$company_contact_phone;?>">
                    </div>
                    <div class="form-group">
                        <label>Company Address 1</label>
                        <input type="text" class="form-control company-info" data-name="company_address1" data-is_summernote="false" value="<?=$company_address1;?>">
                    </div>
                    <div class="form-group">
                        <label>Company Address 2</label>
                        <input type="text" class="form-control company-info" data-name="company_address2" data-is_summernote="false" value="<?=$company_address2;?>">
                    </div>
                    <div class="form-group">
                        <label>Company Logo</label>
                        <div id="company_logo_upload_error" style="margin-top:10px;display:none"></div>
                        <input type="file" name="image" class="single-image-input" data-rename_to="logo" data-error_div="company_logo_upload_error" data-target_value="company_logo">
                        <input id="company_logo" type="hidden" class="company-info" data-name="company_logo" value="<?=$home_section_data->company_logo;?>" data-is_summernote="false">
                    </div>

                    <div class="text-right">
                        <input type="hidden" class="company-info" data-name="data_for" value="company_info" data-is_summernote="false">
                        <a href="javascript:void(0);" class="btn btn-primary save-company-info">Save</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">About Us</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>About Us</label>
                        <div class="summernote about-us" data-name="about_us_text" data-is_summernote="true"><?=urldecode($home_section_data->about_us_text);?></div>
                    </div>
                    <div class="form-group">
                        <label>Image <span class="text-success" data-toggle="popover" data-placement="auto" data-trigger="hover" title="Notes" data-content="For best result, please use image with resolution 800x600"><i class="fa fa-info-circle"></i></span></label>
                        <div id="about_us_image_upload_error" style="margin-top:10px;display:none"></div>
                        <input type="file" name="image" class="single-image-input" data-rename_to="about_us" data-error_div="about_us_image_upload_error" data-target_value="about_us_image">
                        <input id="about_us_image" type="hidden" class="about-us" data-name="about_us_image" value="<?=$home_section_data->about_us_image;?>" data-is_summernote="false">
                    </div>

                    <div class="text-right">
                        <input type="hidden" class="about-us" data-name="data_for" value="about_us" data-is_summernote="false">
                        <a href="javascript:void(0);" class="btn btn-primary save-about-us">Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Home Slider <span class="text-success" data-toggle="popover" data-placement="auto" data-trigger="hover" title="Notes" data-content="For best result, please use image with resolution 1920x1280"><i class="fa fa-info-circle"></i></span></h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
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
                                $slider_image1 = $slider['image'];
                                $slider_text1 = $slider['txt'];
                            } 
                            elseif ($i == 1) {
                                $slider_image2 = $slider['image'];
                                $slider_text2 = $slider['txt'];
                            }
                            elseif ($i == 2) {
                                $slider_image3 = $slider['image'];
                                $slider_text3 = $slider['txt'];
                            }
                        }
                    ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Slider Image 1</label>
                                <div id="slider_image1_upload_error" style="margin-top:10px;display:none"></div>
                                <input type="file" name="image" class="single-image-input" data-rename_to="slider_image1" data-error_div="slider_image1_upload_error" data-target_value="slider_image1">
                                <input id="slider_image1" type="hidden" class="home-slider-image" data-name="slider_image1" value="<?=$slider_image1;?>" data-is_summernote="false">
                            </div>
                            <div class="form-group">
                                <label>Title 1</label>
                                <div class="summernote home-slider-text" data-name="slider_text1" data-is_summernote="true"><?=urldecode($slider_text1);?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Slider Image 2</label>
                                <div id="slider_image2_upload_error" style="margin-top:10px;display:none"></div>
                                <input type="file" name="image" class="single-image-input" data-rename_to="slider_image2" data-error_div="slider_image2_upload_error" data-target_value="slider_image2">
                                <input id="slider_image2" type="hidden" class="home-slider-image" data-name="slider_image2" value="<?=$slider_image2;?>" data-is_summernote="false">
                            </div>
                            <div class="form-group">
                                <label>Title 2</label>
                                <div class="summernote home-slider-text" data-name="slider_text2" data-is_summernote="true"><?=urldecode($slider_text2);?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Slider Image 3</label>
                                <div id="slider_image3_upload_error" style="margin-top:10px;display:none"></div>
                                <input type="file" name="image" class="single-image-input" data-rename_to="slider_image3" data-error_div="slider_image3_upload_error" data-target_value="slider_image3">
                                <input id="slider_image3" type="hidden" class="home-slider-image" data-name="slider_image3" value="<?=$slider_image3;?>" data-is_summernote="false">
                            </div>
                            <div class="form-group">
                                <label>Title 3</label>
                                <div class="summernote home-slider-text" data-name="slider_text3" data-is_summernote="true"><?=urldecode($slider_text3);?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr/>
                            <div class="text-right">
                                <input type="hidden" class="home-slider" data-name="data_for" value="home_slider" data-is_summernote="false">
                                <a href="javascript:void(0);" class="btn btn-primary save-home-slider">Save</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Our Services</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <?php 
                        $our_services = ($home_section_data->services_json) ? json_decode($home_section_data->services_json, TRUE) : []; 
                        $first_service = array_shift($our_services);
                    ?>
                    <div class="text-right">
                        <a href="javascript:void(0);" class="btn btn-primary btn-xs add-our-services"><i class="fa fa-plus"></i></a>
                    </div>
                    <div id="our_services_form">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control our-services-title" value="<?=($first_service) ? $first_service['title'] : '';?>">
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea class="form-control our-services-content"><?=($first_service) ? $first_service['content'] : '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Style</label>
                            <select class="form-control our-services-style">
                                <option value="" <?php if ($first_service['style'] == '') echo 'selected'; ?>>Bright</option>
                                <option value="darker" <?php if ($first_service['style'] == 'darker') echo 'selected'; ?>>Dark</option>
                            </select>
                        </div>
                    </div>
                    <div id="others_our_services_form">
                        <?php 
                            $idx_our_services = 0; 
                            foreach ($our_services as $service) : 
                                $idx_our_services++; 
                        ?>
                            <div id="our_services_<?=$idx_our_services;?>">
                                <hr/>
                                <div class="text-right"><a href="javascript:void(0);" data-id="<?=$idx_our_services;?>" class="btn btn-danger btn-xs delete-our-services"><i class="fa fa-minus"></i></a></div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control our-services-title" value="<?=$service['title'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea class="form-control our-services-content"><?=$service['content'];?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Style</label>
                                    <select class="form-control our-services-style">
                                        <option value="" <?php if ($service['style'] == '') echo 'selected'; ?>>Bright</option>
                                        <option value="darker" <?php if ($service['style'] == 'darker') echo 'selected'; ?>>Dark</option>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>                  
                    <div class="text-right">
                        <input type="hidden" class="our-services-idx" value="<?=$idx_our_services;?>">
                        <input type="hidden" class="our-services" data-name="data_for" value="our_services" data-is_summernote="false">
                        <a href="javascript:void(0);" class="btn btn-primary save-our-services">Save</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Working Areas</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <?php 
                        $working_areas = ($home_section_data->working_areas_json) ? json_decode($home_section_data->working_areas_json, TRUE) : []; 
                        $first_working_areas = array_shift($working_areas);
                    ?>
                    <div class="text-right">
                        <a href="javascript:void(0);" class="btn btn-primary btn-xs add-working-areas"><i class="fa fa-plus"></i></a>
                    </div>
                    <div id="working_areas_form">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control working-areas-title" value="<?=($first_working_areas) ? $first_working_areas['title'] : '';?>">
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea class="form-control working-areas-content"><?=($first_working_areas) ? $first_working_areas['content'] : '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Style</label>
                            <select class="form-control working-areas-style">
                                <option value="" <?php if ($first_working_areas['style'] == '') echo 'selected'; ?>>Bright</option>
                                <option value="darker" <?php if ($first_working_areas['style'] == 'darker') echo 'selected'; ?>>Dark</option>
                            </select>
                        </div>
                    </div>
                    <div id="others_working_areas_form">
                        <?php 
                            $idx_working_areas = 0; 
                            foreach ($working_areas as $working) : 
                                $idx_working_areas++; 
                        ?>
                            <div id="working_areas_<?=$idx_working_areas;?>">
                                <hr/>
                                <div class="text-right"><a href="javascript:void(0);" data-id="<?=$idx_working_areas;?>" class="btn btn-danger btn-xs delete-working-areas"><i class="fa fa-minus"></i></a></div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control working-areas-title" value="<?=$working['title'];?>">
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea class="form-control working-areas-content"><?=$working['content'];?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Style</label>
                                    <select class="form-control working-areas-style">
                                        <option value="" <?php if ($working['style'] == '') echo 'selected'; ?>>Bright</option>
                                        <option value="darker" <?php if ($working['style'] == 'darker') echo 'selected'; ?>>Dark</option>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>                  
                    <div class="text-right">
                        <input type="hidden" class="working-areas-idx" value="<?=$idx_working_areas;?>">
                        <input type="hidden" class="working-areas" data-name="data_for" value="working_areas" data-is_summernote="false">
                        <a href="javascript:void(0);" class="btn btn-primary save-working-areas">Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Divider Visibility</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="panel-body">
                    <div class="checkbox checkbox-switch">
                        <label>
                            <input type="checkbox" class="switch divider-visibility" value="<?=$home_section_data->visitor_count_visibility;?>" data-on-text="On" data-off-text="Off" <?php if ($home_section_data->visitor_count_visibility == 1) echo 'checked'; ?> data-name="visitor_counter" data-is_summernote="false"> Visitor Counter
                        </label>
                    </div>
                    <div class="checkbox checkbox-switch">
                        <label>
                            <input type="checkbox" class="switch divider-visibility" value="<?=$home_section_data->twitter_visibility;?>" data-on-text="On" data-off-text="Off" <?php if ($home_section_data->twitter_visibility == 1) echo 'checked'; ?> data-name="twitter_ticker" data-is_summernote="false"> Twitter Ticker
                        </label>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <label>Parallax Image <span class="text-success" data-toggle="popover" data-placement="auto" data-trigger="hover" title="Notes" data-content="For best result, please use image with resolution 1920x1280"><i class="fa fa-info-circle"></i></span></label>
                        <div id="parallax_image_upload_error" style="margin-top:10px;display:none"></div>
                        <input type="file" name="image" class="single-image-input" data-rename_to="parallax_image" data-error_div="parallax_image_upload_error" data-target_value="parallax_image">
                        <input id="parallax_image" type="hidden" class="divider-visibility" data-name="parallax_image" value="" data-is_summernote="false">
                    </div>

                    <div class="text-right">
                        <input type="hidden" class="divider-visibility" data-name="data_for" value="divider_visibility" data-is_summernote="false">
                        <a href="javascript:void(0);" class="btn btn-primary save-divider-visibility">Save</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Social Media</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <?php $socmed_link = ($home_section_data->socmed_link_json) ? json_decode($home_section_data->socmed_link_json, TRUE) : []; ?>
                    <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" class="form-control social-media" data-name="facebook_link" data-is_summernote="false" value="<?=(isset($socmed_link['facebook_link'])) ? $socmed_link['facebook_link'] : '';?>">
                    </div>
                    <div class="form-group">
                        <label>Twitter</label>
                        <input type="text" class="form-control social-media" data-name="twitter_link" data-is_summernote="false" value="<?=(isset($socmed_link['twitter_link'])) ? $socmed_link['twitter_link'] : '';?>">
                    </div>
                    <div class="form-group">
                        <label>LinkedIn</label>
                        <input type="text" class="form-control social-media" data-name="linkedin_link" data-is_summernote="false" value="<?=(isset($socmed_link['linkedin_link'])) ? $socmed_link['linkedin_link'] : '';?>">
                    </div>
                    <div class="text-right">
                        <input type="hidden" class="social-media" data-name="data_for" value="social_media" data-is_summernote="false">
                        <a href="javascript:void(0);" class="btn btn-primary save-social-media">Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content area -->