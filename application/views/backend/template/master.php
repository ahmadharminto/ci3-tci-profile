<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('backend/template/header'); ?>
<body class="navbar-top">
	<?php $this->load->view('backend/template/nav'); ?>
	<div class="page-container">
		<div class="page-content">
			<?php $this->load->view('backend/template/sidebar'); ?>
			<div class="content-wrapper">
				<?php if (isset($content)) echo $content; ?>
				<?php $this->load->view('backend/template/footer'); ?>
			</div>
		</div>
	</div>
	<?php $this->load->view('backend/template/javascript'); ?>
	<?php if (isset($js_content)) echo $js_content; ?>
</body>
</html>
