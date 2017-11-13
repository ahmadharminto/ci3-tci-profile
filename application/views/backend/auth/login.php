<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ahmad-Harminto" />
	<meta name="<?=$this->security->get_csrf_token_name();?>" content="<?=$this->security->get_csrf_hash();?>" />

    <title>PT Trust Certified International</title>

	<?php $this->load->view('favicon'); ?>

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/icons/icomoon/styles.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/bootstrap.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/core.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/components.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('public/templates/limitless/css/colors.css');?>" rel="stylesheet" type="text/css">
</head>

<body class="login-container">
	<div class="page-container">
		<div class="page-content">
			<div class="content-wrapper">
				<div class="content">
                    <?php $attributes = array("name" => "loginform", "method" => "post"); ?>
                    <?=form_open('/cpanel/auth/check', $attributes);?>
						<div class="panel panel-body login-form">
							<?php echo $this->session->flashdata('login_msg'); ?>
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
							</div>
							<div class="form-group has-feedback has-feedback-left">
								<input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $this->session->flashdata('email'); ?>">
								<div class="form-control-feedback"><i class="icon-user text-muted"></i></div>
                                <span class="text-danger"><?php echo form_error('email'); ?></span>
							</div>
							<div class="form-group has-feedback has-feedback-left">
								<input type="password" name="password" class="form-control" placeholder="Password">
								<div class="form-control-feedback"><i class="icon-lock2 text-muted"></i></div>
                                <span class="text-danger"><?php echo form_error('password'); ?></span>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
							</div>
						</div>
					<?=form_close();?>

					<div class="footer text-muted text-center">
						&copy; <?=date('Y');?>. <a href="<?=base_url();?>">Trust Certified International</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/plugins/loaders/pace.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/core/libraries/jquery.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/core/libraries/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/plugins/loaders/blockui.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/core/app.js');?>"></script>
</body>
</html>
