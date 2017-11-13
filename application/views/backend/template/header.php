<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ahmad-Harminto" />
	<meta name="<?=$this->security->get_csrf_token_name();?>" content="<?=$this->security->get_csrf_hash();?>" />

    <title>.::CPanel::.</title>

	<?php $this->load->view('favicon'); ?>

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/icons/icomoon/styles.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/bootstrap.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/core.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/components.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/colors.css');?>" rel="stylesheet" type="text/css">
</head>