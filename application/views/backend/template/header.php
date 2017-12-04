<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ahmad-Harminto" />
	<meta name="<?=$this->security->get_csrf_token_name();?>" content="<?=$this->security->get_csrf_hash();?>" />

    <title>.::TCI-Panel::.</title>

	<?php $this->load->view('favicon'); ?>

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/icons/icomoon/styles.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/icons/fontawesome/styles.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/bootstrap.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/core.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/components.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/colors.css');?>" rel="stylesheet" type="text/css">

	<script type="text/javascript">
        var CSRF_COOKIE_NAME = '<?php echo $this->config->item('csrf_cookie_name'); ?>';
		var BASE_URL = '<?=base_url();?>';
    </script>
</head>