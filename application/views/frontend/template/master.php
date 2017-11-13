<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('frontend/template/header'); ?>
<body>
    <div id="wrapper">
        <div id="preloader"><div id="spinner"></div></div>

        <?php $this->load->view('frontend/template/nav'); ?>

        <div class="main-content">
            <?php if (isset($content)) echo $content; ?>
        </div>

        <?php $this->load->view('frontend/template/footer'); ?>
    </div>
    
    <?php $this->load->view('frontend/template/javascript'); ?>
</body>
</html>