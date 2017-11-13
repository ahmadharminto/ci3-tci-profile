<script type="text/javascript">
    var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
        '  <div class="modal-content">\n' +
        '    <div class="modal-header">\n' +
        '      <div class="kv-zoom-actions btn-group">{fullscreen}{borderless}{close}</div>\n' +
        '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
        '    </div>\n' +
        '    <div class="modal-body">\n' +
        '      <div class="floating-buttons btn-group"></div>\n' +
        '      <div class="kv-zoom-body file-zoom-content"></div>\n' +
        '    </div>\n' +
        '  </div>\n' +
        '</div>\n';

    $(document).ready(function() {
        $('.file-input').fileinput({
            showCancel: false,
            showPreview: true,
            showCaption: true,
            showUploadedThumbs: true,
            showUpload: true,
            uploadLabel: 'Upload',
            uploadClass: 'btn btn-default btn-icon',   
            uploadIcon: '<i class="icon-file-upload"></i> ',       
            showRemove: true,
            removeLabel: 'Clear Selected',
            removeTitle: 'Clear Selected',
            removeClass: 'btn btn-danger btn-icon',
            // removeIcon: '<i class="icon-cancel-square"></i> ',
            browseLabel: 'Browse',
            browseClass: 'btn btn-primary btn-icon',
            browseIcon: '<i class="icon-plus22"></i> ',            
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            fileActionSettings: {
                showRemove: false,
                showUpload: false,
                showZoom: true,
                showDrag: false,
            },
            initialCaption: "No file selected",
            allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
            uploadAsync: false,
            uploadUrl: "<?=base_url('/tci-admin/home/upload');?>",
            uploadExtraData: function() {
                return {
                    '<?=$this->security->get_csrf_token_name();?>': $.cookie(csrf_cookie_name)
                };
            },
            elErrorContainer: '#upload_error'
        });
    });
</script>