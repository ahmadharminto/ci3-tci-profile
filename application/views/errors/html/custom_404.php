<?php $this->load->view('frontend/template/header'); ?>

<div class="main-content">
    <section id="home" class="divider fullscreen bg16 layer-overlay overlay-dark">
        <div class="home-content text-center">
            <div class="home-text">
                <div class="container pt-0 pb-0">
                    <div class="row">
                        <div class="col-md-12 mt-60">
                            <h1 class="medium-large text-white">Error <span>404!</span></h1>
                            <h2 class="text-white">Oops! Page Not Found</h2>
                            <p>The page you were looking for could not be found.</p>
                            <a class="btn btn-default btn-white smooth-scroll" href="<?php echo base_url(); ?>">Back to Home</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>
</div>
<footer></footer>
</div>

<?php $this->load->view('frontend/template/javascript'); ?>