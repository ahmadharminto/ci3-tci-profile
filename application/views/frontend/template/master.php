<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('frontend/template/header', ['title' => (isset($title)) ? $title : 'PT. Trust Certified International']); ?>
<body>
    <div id="wrapper">
        <div id="preloader"><div id="spinner"></div></div>

        <?php if(isset($nav)) echo $nav; ?>

        <div class="main-content">
            <?php if (isset($content)) echo $content; ?>
        </div>

        <?php if (isset($footer)) echo $footer; ?>
    </div>
    
    <?php $this->load->view('frontend/template/javascript'); ?>
</body>
</html>