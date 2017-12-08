<script type="text/javascript">
    var zoomModalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
        '  <div class="modal-content">\n' +
        '    <div class="modal-header">\n' +
        '      <div class="kv-zoom-actions btn-group">{fullscreen}{borderless}{close}</div>\n' +
        '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
        '    </div>\n' +
        '    <div class="modal-body">\n' +
        '      <hr/>\n' +
        '      <div class="floating-buttons btn-group"></div>\n' +
        '      <div class="kv-zoom-body file-zoom-content"></div>\n' +
        '    </div>\n' +
        '  </div>\n' +
        '</div>\n';

    var idx_our_services = 0;
    var idx_working_areas = 0;

    function read_field_as_json(class_id)
    {
        var tmp_data = '{';
        var tmp_idx = 0;

        $(class_id).each(function(index, field) {
            if ($(field).data('is_summernote') == false) { 
                if ($(field).val() != '' && $(field).val() != null) {
                    if (tmp_idx == 0) tmp_data += '"' + $(field).data('name') + '" : "' + encodeURI($(field).val().replace(/"/g, '\\"')) + '"';
                    else tmp_data += ', "' + $(field).data('name') + '" : "' + encodeURI($(field).val().replace(/"/g, '\\"')) + '"';
                    tmp_idx++;
                }
            }
            else {
                if ($(field).summernote('isEmpty') == false) {
                    if (tmp_idx == 0) tmp_data += '"' + $(field).data('name') + '" : "' + encodeURI($(field).summernote('code')) + '"';
                    else tmp_data += ', "' + $(field).data('name') + '" : "' + encodeURI($(field).summernote('code')) + '"';
                    tmp_idx++;
                }
            }
        });

        tmp_data += '}';

        var data = JSON.parse(tmp_data);

        var cnt = Object.keys(data).length;
        if (cnt > 0) {
            data.id_home_section = $('#id_home_section').val();
            data.<?=$this->security->get_csrf_token_name();?> = $.cookie(CSRF_COOKIE_NAME);
        }

        return data;
    }

    function post_data(data, message_success)
    {
        $.post('<?=$url_save_data;?>', data, function(databack) {
            if (databack.code == 200) {
                $('#flash_message').html('<div class="alert alert-success flash-alert text-center">' + message_success + '</div>');
                $('.flash-alert').delay(5000).fadeOut(500);
            }
            else {
                $('#flash_message').html('<div class="alert alert-danger flash-alert text-center">Something Wrong : ' + databack.error + '</div>');
                $('.flash-alert').delay(5000).fadeOut(500);
            }
            $('html, body').animate({ scrollTop: 0 }, 'fast');
        }).fail(function(jqXHR, textStatus, errorThrown) { 
            console.log(textStatus);
            console.log(errorThrown);
        }); 
    }

    $(document).ready(function() {
        idx_our_services = $('.our-services-idx').val();
        idx_working_areas = $('.working-areas-idx').val();

        $('[data-toggle="popover"]').popover({
            template: '<div class="popover" role="tooltip" style="width: 100%;">' +
                '<div class="arrow"></div>' +
                '<h5 class="popover-title"></h5>' +
                '<div class="popover-content">' +
                '<div class="data-content"></div>' +
                '</div>' +
                '</div>',
            html: true
        });

        $('a[data-action="collapse"]').trigger('click');

        $('.summernote').on('summernote.init', function () {
            // $('.summernote').summernote('codeview.activate');
        }).summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['misc', ['fullscreen', 'codeview']]
            ]
        });

        $('.switch').bootstrapSwitch();

        $('.switch').on('switchChange.bootstrapSwitch', function(event, state) {
            if (state == true) $(this).val(1);
            else $(this).val(0);
        });

        $('.save-company-info').click(function(e) {
            var data = read_field_as_json('.company-info');

            if (Object.keys(data).length > 0) {
                post_data(data, 'Company Info Saved!');
            }
        });

        $('.save-about-us').click(function(e) {
            var data = read_field_as_json('.about-us');
            
            if (Object.keys(data).length > 0) {
                post_data(data, 'About Us Saved!');
            }
        });

        $('.save-home-slider').click(function(e) {
            var image = new Array();
            var txt = new Array();
            $('.home-slider-image').each(function (index, field) {
                image.push($(field).val());
            });
            $('.home-slider-text').each(function (index, field) {
                if ($(field).summernote('isEmpty') == false) {
                    var tmp_data = encodeURI($(field).summernote('code'));
                    txt.push(tmp_data);
                }
            });

            if (image.length > 0  && txt.length > 0) {
                var data = read_field_as_json('.home-slider');
                data.image = image;
                data.txt = txt;

                post_data(data, 'Home Slider Saved!');
            }
        });

        $('.add-our-services').click(function(e) {
            idx_our_services++;
            var delete_btn = '<div class="text-right"><a href="javascript:void(0);" data-id="' + idx_our_services + '" class="btn btn-danger btn-xs delete-our-services"><i class="fa fa-minus"></i></a></div>';
            var template = '<div id="our_services_' + idx_our_services + '"><hr/>' + delete_btn + $('#our_services_form').clone().html() + '</div>';
            $('#others_our_services_form').append(template);

            $('#our_services_' + idx_our_services).find('input.our-services-title').val('');
            $('#our_services_' + idx_our_services).find('textarea.our-services-content').val('');
        });

        $('#others_our_services_form').on('click', '.delete-our-services', function(e) {
            var idx = $(this).data('id');
            $('#our_services_' + idx).remove();
        });

        $('.save-our-services').click(function(e) {
            var title = new Array();
            var content = new Array();
            var style = new Array();
            $('.our-services-title').each(function (index, field) {
                title.push($(field).val());
            });
            $('.our-services-content').each(function (index, field) {
                content.push($(field).val());
            });
            $('.our-services-style').each(function (index, field) {
                style.push($(field).val());
            });

            if (title.length > 0  && content.length > 0) {
                var data = read_field_as_json('.our-services');
                data.title = title;
                data.content = content;
                data.style = style;

                post_data(data, 'Our Services Saved!'); 
            }
        });

        $('.add-working-areas').click(function(e) {
            idx_working_areas++;
            var delete_btn = '<div class="text-right"><a href="javascript:void(0);" data-id="' + idx_working_areas + '" class="btn btn-danger btn-xs delete-working-areas"><i class="fa fa-minus"></i></a></div>';
            var template = '<div id="working_areas_' + idx_working_areas + '"><hr/>' + delete_btn + $('#working_areas_form').clone().html() + '</div>';
            $('#others_working_areas_form').append(template);

            $('#working_areas_' + idx_working_areas).find('input.working-areas-title').val('');
            $('#working_areas_' + idx_working_areas).find('textarea.working-areas-content').val('');
        });

        $('#others_working_areas_form').on('click', '.delete-working-areas', function(e) {
            var idx = $(this).data('id');
            $('#working_areas_' + idx).remove();
        });

        $('.save-working-areas').click(function(e) {
            var title = new Array();
            var content = new Array();
            var style = new Array();
            $('.working-areas-title').each(function (index, field) {
                title.push($(field).val());
            });
            $('.working-areas-content').each(function (index, field) {
                content.push($(field).val());
            });
            $('.working-areas-style').each(function (index, field) {
                style.push($(field).val());
            });

            if (title.length > 0  && content.length > 0) {
                var data = read_field_as_json('.working-areas');
                data.title = title;
                data.content = content;
                data.style = style;

                post_data(data, 'Working Areas Saved!'); 
            }
        });

        $('.save-divider-visibility').click(function(e) {
            var data = read_field_as_json('.divider-visibility');
            post_data(data, 'Divider Visibility Saved!');
        });

        $('.save-social-media').click(function(e) {
            var data = read_field_as_json('.social-media');
            post_data(data, 'Social Media Link Saved!');
        });

        $('.single-image-input').each(function(index, field) {
            var error_div = $(field).data('error_div');
            var rename_to = $(field).data('rename_to');
            var target_value = $(field).data('target_value');

            $(field).fileinput({
                showCancel: false,
                showPreview: true,
                showCaption: true,
                showUploadedThumbs: true,
                showUpload: true,
                uploadLabel: 'Upload',
                uploadClass: 'btn btn-success btn-icon',   
                uploadIcon: '<i class="icon-file-upload"></i> ',       
                showRemove: false,
                removeLabel: 'Clear Selected',
                removeTitle: 'Clear Selected',
                removeClass: 'btn btn-danger btn-icon',
                // removeIcon: '<i class="icon-cancel-square"></i> ',
                browseLabel: 'Browse',
                browseClass: 'btn btn-default btn-icon',
                browseIcon: '<i class="icon-plus22"></i> ',            
                layoutTemplates: {
                    icon: '<i class="icon-file-check"></i>',
                    modalMain: '<div id="kvFileinputModal" class="file-zoom-dialog modal fade" tabindex="-1" aria-labelledby="kvFileinputModalLabel"></div>',
                    modal: zoomModalTemplate
                },
                fileActionSettings: {
                    showRemove: true,
                    showUpload: false,
                    showZoom: true,
                    showDrag: false,
                },
                initialCaption: "No file selected",
                allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
                uploadAsync: false,
                maxFileCount: 1,
                uploadUrl: BASE_URL + 'tci-admin/home/uploader',
                uploadExtraData: function() {
                    return {
                        '<?=$this->security->get_csrf_token_name();?>': $.cookie(CSRF_COOKIE_NAME),
                        'rename_to': rename_to
                    };
                },
                elErrorContainer: '#' + error_div,
                overwriteInitial: true
            }).on('filebatchuploadsuccess', function(event, data, previewId, index) {
                var form = data.form, files = data.files, extra = data.extra, response = data.response, reader = data.reader;
                $('#' + target_value).val(response.file_name);
                $(field).fileinput('reset')
                    .fileinput('clear')
                    .fileinput('refresh', {
                        initialPreview: [
                            '<img src="' + BASE_URL + 'public/images/upload/' + response.file_name + '?ts=' + new Date().getTime() + '" class="file-preview-image" alt="' + response.file_name + '" title="' + response.file_name + '">'
                        ],
                        initialPreviewConfig: [
                            {
                                caption: response.file_name,
                                size: response.file_size * 1024,
                                filetype: response.file_type,
                                width: '120px',
                                url: BASE_URL + 'tci-admin/home/delete_uploaded',
                                key: 0,
                                extra: {
                                    '<?=$this->security->get_csrf_token_name();?>': $.cookie(CSRF_COOKIE_NAME),
                                    file_name: response.file_name
                                }
                            }
                        ]
                    })
                    .fileinput('enable');
            }).on('filedeleted', function(event, key, jqXHR, data) {
                $('#' + target_value).val('');
            });
        });

        <?php if ($home_section_data->company_logo) : ?>
            $('.single-image-input').each(function(index, field) {
                if ($(field).data('target_value') == 'company_logo') {
                    $(field).fileinput('reset')
                        .fileinput('clear')
                        .fileinput('refresh', {
                            initialPreview: [
                                '<img src="' + BASE_URL + 'public/images/upload/<?=$home_section_data->company_logo;?>?ts=' + new Date().getTime() + '" class="file-preview-image" alt="<?=$home_section_data->company_logo;?>" title="<?=$home_section_data->company_logo;?>">'
                            ],
                            initialPreviewConfig: [
                                {
                                    caption: '<?=$home_section_data->company_logo;?>',
                                    width: '120px',
                                    url: BASE_URL + 'tci-admin/home/delete_uploaded',
                                    key: 0,
                                    extra: {
                                        '<?=$this->security->get_csrf_token_name();?>': $.cookie(CSRF_COOKIE_NAME),
                                        file_name: '<?=$home_section_data->company_logo;?>'
                                    }
                                }
                            ]
                        })
                        .fileinput('enable');

                    return false;
                }
            });
        <?php endif; ?>

        <?php if ($home_section_data->about_us_image) : ?>
            $('.single-image-input').each(function(index, field) {
                if ($(field).data('target_value') == 'about_us_image') {
                    $(field).fileinput('reset')
                        .fileinput('clear')
                        .fileinput('refresh', {
                            initialPreview: [
                                '<img src="' + BASE_URL + 'public/images/upload/<?=$home_section_data->about_us_image;?>?ts=' + new Date().getTime() + '" class="file-preview-image" alt="<?=$home_section_data->about_us_image;?>" title="<?=$home_section_data->about_us_image;?>">'
                            ],
                            initialPreviewConfig: [
                                {
                                    caption: '<?=$home_section_data->about_us_image;?>',
                                    width: '120px',
                                    url: BASE_URL + 'tci-admin/home/delete_uploaded',
                                    key: 0,
                                    extra: {
                                        '<?=$this->security->get_csrf_token_name();?>': $.cookie(CSRF_COOKIE_NAME),
                                        file_name: '<?=$home_section_data->about_us_image;?>'
                                    }
                                }
                            ]
                        })
                        .fileinput('enable');

                    return false;
                }
            });
        <?php endif; ?>

        <?php if ($home_section_data->parallax_bground_img) : ?>
            $('.single-image-input').each(function(index, field) {
                if ($(field).data('target_value') == 'parallax_image') {
                    $(field).fileinput('reset')
                        .fileinput('clear')
                        .fileinput('refresh', {
                            initialPreview: [
                                '<img src="' + BASE_URL + 'public/images/upload/<?=$home_section_data->parallax_bground_img;?>?ts=' + new Date().getTime() + '" class="file-preview-image" alt="<?=$home_section_data->parallax_bground_img;?>" title="<?=$home_section_data->parallax_bground_img;?>">'
                            ],
                            initialPreviewConfig: [
                                {
                                    caption: '<?=$home_section_data->parallax_bground_img;?>',
                                    width: '120px',
                                    url: BASE_URL + 'tci-admin/home/delete_uploaded',
                                    key: 0,
                                    extra: {
                                        '<?=$this->security->get_csrf_token_name();?>': $.cookie(CSRF_COOKIE_NAME),
                                        file_name: '<?=$home_section_data->parallax_bground_img;?>'
                                    }
                                }
                            ]
                        })
                        .fileinput('enable');

                    return false;
                }
            });
        <?php endif; ?>

        $('.home-slider-image').each(function(idx, fld) {
            if ($(fld).val() != '') {
                var name = $(fld).data('name');
                var value = $(fld).val();

                $('.single-image-input').each(function(index, field) {
                    if ($(field).data('target_value') == name) {
                        $(field).fileinput('reset')
                            .fileinput('clear')
                            .fileinput('refresh', {
                                initialPreview: [
                                    '<img src="' + BASE_URL + 'public/images/upload/' + value + '?ts=' + new Date().getTime() + '" class="file-preview-image" alt="' + value + '" title="' + value + '">'
                                ],
                                initialPreviewConfig: [
                                    {
                                        caption: '<?=$home_section_data->parallax_bground_img;?>',
                                        width: '120px',
                                        url: BASE_URL + 'tci-admin/home/delete_uploaded',
                                        key: 0,
                                        extra: {
                                            '<?=$this->security->get_csrf_token_name();?>': $.cookie(CSRF_COOKIE_NAME),
                                            file_name: '<?=$home_section_data->parallax_bground_img;?>'
                                        }
                                    }
                                ]
                            })
                            .fileinput('enable');

                        return false;
                    }
                });
            }
        });

        $("#kvFileinputModal").detach().appendTo('.content');

        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
            $('.modal').on("hidden.bs.modal", function (e) { //fire on closing modal box
                if ($('.modal:visible').length) { // check whether parent modal is opend after child modal close
                    $('body').addClass('modal-open'); // if open mean length is 1 then add a bootstrap css class to body of the page
                }
            });
        });
    });
</script>