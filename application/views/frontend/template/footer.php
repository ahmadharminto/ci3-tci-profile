<footer id="footer" class="footer p-0">
    <div class="container pt-70 pb-70">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="footer-widget">
                    <img height="35" src="<?=base_url('public/images/logo.png');?>" alt="" style="max-height:75px; max-width:250px;">
                    <p class="mt-20 mb-20">PT Trust Certified International</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="footer-widget">
                    <h4 class="widget-title">Connect with us!</h4>
                    <ul class="list-divider font-12">
                        <li><a href="#"><i class="fa fa-user text-black-light mr-10"></i> care@trustcertified.co.id, trustcertint@gmail.com</a></li>
                        <li><a href="#"><i class="fa fa-phone text-black-light mr-10"></i> +62 812 9862 1159, +62 812 8453 5765 </a></li>
                        <li><a href="#"><i class="fa fa-map-marker text-black-light mr-10"></i> Jakarta Office: Jl. Mampang Prapatan Raya 98 D-F Jakarta Selatan</a></li>
                        <li><a href="#"><i class="fa fa-map-marker text-black-light mr-10"></i> Samarinda Office: Jl. Untung Surapati No. 16 Samarinda</a></li>
                    </ul>
                    <ul class="social-icons square list-inline">
                        <li><a href="https://www.facebook.com/trustcertint/" target="_blank"><i class="fa fa-facebook"></i></a> </li>
                        <li><a href="https://twitter.com/trustcertint?lang=en" target="_blank"><i class="fa fa-twitter"></i></a> </li>
                        <li><a href="https://www.linkedin.com/in/trustcertint" target="_blank"><i class="fa fa-linkedin"></i></a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="footer-widget"></div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="section-content">
                    <?php echo $this->session->flashdata('contact_msg'); ?>
                    <?php $attributes = array("class" => "form-horizontal", "name" => "contactform", "method" => "post"); ?>
                    <?php echo form_open("page/home/sendContactForm.pg#footer", $attributes);?>
                    <fieldset>
                        <legend>Interested in discussing?</legend>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Name</label>
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" name="name" placeholder="Your Full Name" type="text" value="<?php echo set_value('name'); ?>" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="email" class="control-label">Email ID</label>
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" name="email" placeholder="Your Email ID" type="text" value="<?php echo set_value('email'); ?>" />
                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="subject" class="control-label">Subject</label>
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" name="subject" placeholder="Your Subject" type="text" value="<?php echo set_value('subject'); ?>" />
                                <span class="text-danger"><?php echo form_error('subject'); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="message" class="control-label">Message</label>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="4" placeholder="Your Message"><?php echo set_value('message'); ?></textarea>
                                <span class="text-danger"><?php echo form_error('message'); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="g-recaptcha" data-sitekey="6LddnDMUAAAAACX4ManwsIYhiCacVFLMqp3W1hTm"></div>
                                <span class="text-danger"><?php echo form_error('g-recaptcha-response'); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-default" data-loading-text="Please wait...">Send your message</button>
                            </div>
                        </div>
                    </fieldset>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-solid-color bg-dark p-20">
        <div class="row text-center">
            <div class="col-md-12">
                <p class="font-14 m-0">Copyright ©<?=date('Y');?> TCI. All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>

<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>