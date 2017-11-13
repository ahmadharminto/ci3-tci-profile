<script type="text/javascript">
    $(document).ready(function() {
        <?=my_datatables('#ut-table', $url_datatables, $start_page, $display_page, $header_disabled, $data_filter);?>
    });
</script>