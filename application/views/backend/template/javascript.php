<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/plugins/loaders/pace.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('public/js/jquery-2.1.1.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('public/js/jquery.cookie.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/core/libraries/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/plugins/ui/nicescroll.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/plugins/uploaders/fileinput.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/core/app.js');?>"></script>
<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/pages/layout_fixed_custom.js');?>"></script>
<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/plugins/tables/datatables/datatables.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/plugins/forms/selects/select2.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('public/templates/limitless/js/plugins/notifications/noty.min.js');?>"></script>
<script type="text/javascript">
    var csrf_cookie_name = '<?php echo $this->config->item('csrf_cookie_name'); ?>';
    $(document).ready(function() {
        $('.flash-alert').delay(5000).fadeOut(500);

        <?php if ($this->session->userdata('csrf_mismatch')) : ?>
            noty({
                layout: 'top',
                type: 'warning',
                text: '<?=$this->session->userdata('csrf_mismatch');?>',
                timeout: 3000
            });
        <?php 
                $this->session->unset_userdata('csrf_mismatch');
            endif;
        ?>
    });
</script>