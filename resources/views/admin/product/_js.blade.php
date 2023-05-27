<script src="{{ asset('lib/axios.min.js') }}"></script>
<style>
    .tag-error {
        margin-top: 10px;
    }
</style>
<script>
    $(document).ready(function () {
        $('#btn-add-image').click(function () {
            $('#container-images').append(`<input type="file" name="image_news[]" class="image_new" multiple="multiple" accept="image/png, image/gif, image/jpeg" style="display: none;">`);
            $('.image_new').click();
        });

        $('body').on('change', '.image_new', function () {
            for (let i = 0; i < this.files.length; i++) {
                let img_url = URL.createObjectURL(event.target.files[i]);
                let fileType = this.files[i]['type'];
                let validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

                if (validImageTypes.includes(fileType)) {
                    $.ajax({
                        url: @json(route('admin.products.render_image_review')),
                        method: 'GET',
                        data: {
                            image_url: img_url,
                            order: $('#container-images .image-order').length + 1
                        },
                        success: function (data) {
                            $('#container-images').append(data).ready(function () {
                                $('.image_new').detach().appendTo("#container-images .image-item:last");
                                $('.image_new').removeClass('image_new');
                            });
                        }
                    });
                }
            }
        });

        $('body').on('click', '.btn-remove-image', function () {
            let id = $(this).attr('data-id') ?? '';

            if (id != '') {
                $('#form-main').append(`<input type="hidden" name="remove_images[]" value="${id}">`);
            }

            $(this).parents('.image-item').remove();
        });

        let dataHtmlProductChildLisAttr = '';
        const listAttrValueForListProductChild = @json($listAttrValueForListProductChild ?? []);
        $('#btn-add-product-child-new').prop('disabled', true);
        reloadStt();

        function reloadStt() {
            $('#table-product-child .stt').each(function (index) {
                $(this).text(index + 1);
            });

            $('#table-product-child .product-child-list-attr').each(function (index) {
                $(this).attr('stt', index + 1);
            });
        }

        function select2OptionsSelected($elementSelect2) {
            let data = [],
                adapter = $elementSelect2.data().select2.dataAdapter;
            $elementSelect2.children().each(function () {
                if (!$(this).is('option') && !$(this).is('optgroup')) {
                    return true;
                }

                const item = adapter.item($(this));

                if (item.selected) {
                    data.push(item.id);
                }
            });

            return data;
        }

        function reRenderNameListAttrProductChild() {
            $('.product-child-list-attr').each(function () {
                const productId = $(this).attr('data-id');
                const isOld = $(this).attr('data-is-old');
                let nameInput = 'list_product_child_new';

                if (isOld === "1") {
                    nameInput = 'list_product_child';
                }


                $(this).find('input').each(function () {
                    const name = $(this).attr('name');
                    const attrId = $(this).attr('data-id');

                    $(this).attr('name', nameInput + '[' + productId + ']' + name);
                    $(this).val(listAttrValueForListProductChild[productId + '_' + attrId] ?? '');
                });
            });
        }

        function renderAttrFieldParent() {
            const listAttrSelect = select2OptionsSelected($('#list_attribute'));

            $(`#list_attribute_private option`).prop('disabled',false);

            listAttrSelect.forEach(function (item) {
                $(`#list_attribute_private option[value='${item}']`).prop('disabled',true);
            });

            $.LoadingOverlay('show');

            $.ajax({
                method: 'get',
                url: @json(route('admin.renderAttribute')),
                data: {
                    attribute_ids: listAttrSelect,
                    product_id: $('#id').val()
                },
                success: function (data) {
                    $('#div_list_attribute').html(data);
                    $.LoadingOverlay('hide');
                }
            });
        }

        function renderAttrFieldForChild() {
            const listAttrSelect = select2OptionsSelected($('#list_attribute_private'));

            $(`#list_attribute option`).prop('disabled',false);

            listAttrSelect.forEach(function (item) {
                $(`#list_attribute option[value='${item}']`).prop('disabled',true);
            });

            if (listAttrSelect.length > 0) {
                $.LoadingOverlay('show');
                $.ajax({
                    method: 'get',
                    url: @json(route('admin.renderAttributeProductChild')),
                    data: {
                        attribute_ids: listAttrSelect,
                    },
                    success: function (data) {
                        $.LoadingOverlay('hide');
                        data = data.trim();

                        $('.product-child-list-attr').html(data);
                        dataHtmlProductChildLisAttr = data;
                        reRenderNameListAttrProductChild();

                        if (data === '') {
                            $('#btn-add-product-child-new').prop('disabled', true);
                            $('#table-product-child tr:not(:eq(0))').hide();
                        } else {
                            $('#btn-add-product-child-new').prop('disabled', false);
                            $('#table-product-child tr:not(:eq(0))').show();
                        }
                    }
                });
            }
        }

        $('#list_attribute').on('change', function (e) {
            renderAttrFieldParent();
        });

        $('#list_attribute_private').on('change', function (e) {
            renderAttrFieldForChild();
        });

        $('body').on('change', '.input-attr-product-child', function () {
            const productId = $(this).parents('.product-child-list-attr').attr('data-id');
            const attrId = $(this).attr('data-id');
            listAttrValueForListProductChild[productId + '_' + attrId] = $(this).val();
        });

        $('.js-example-basic-multiple').select2();

        $("#list_attribute").trigger("change");
        $("#list_attribute_private").trigger("change");


        $('body').on('click', '.btn-delete-product-child', function () {
            const id = $(this).attr('data-id');

            if (id !== '') {
                $('#form-main').append(`<input type="hidden" value="${id}" name="product_child_id_delete[]">`);
            }

            $(this).parents('tr').remove();
            reloadStt();
        });

        $('#btn-add-product-child-new').click(function () {
            $.LoadingOverlay('show');

            $.ajax({
                url: @json(route('admin.products.render-product-child-new-row')),
                method: 'GET',
                success: function (html) {
                    $.LoadingOverlay('hide');
                    $('#table-product-child').append(html);
                    $('.product-child-list-attr').html(dataHtmlProductChildLisAttr);
                    reRenderNameListAttrProductChild();
                    reloadStt();
                }
            })
        });


        $('#image').change(function (event) {
            $(".img-preview").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        });

        $('.tag-error').hide();

        $('#form-main').submit(function (event) {
            event.preventDefault();
            let formData = new FormData(document.getElementById('form-main'));
            $.LoadingOverlay('show');

            $('.ckeditor').each(function () {
                formData.append($(this).attr('name'), CKEDITOR.instances[$(this).attr('name')].getData());
            });

            axios.post($(this).attr('action'), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function (response) {
                if (response.data.success) {
                    window.location.replace(response.data.url);
                } else {
                    $.LoadingOverlay('hide');

                    $('#div-error-product-child-attr').html('');
                    $('#div-error-product-child-empty').html('');

                    if (response.data.error_attr_config) {
                        alert(response.data.error_attr_config);
                    } else if (response.data.error_product_exists) {
                        for (const [key, value] of Object.entries(response.data.error_product_exists)) {
                            let errorRow = [];

                            value.forEach(function (item) {
                                const stt = $(`.product-child-list-attr[data-id='${item}']`).attr('stt');
                                errorRow.push(stt);
                            });

                            $('#div-error-product-child-attr').append(`<p class="text-danger">Dòng ${errorRow.join(',')} đang bị trùng danh sách thuộc tính</p>`);
                        }

                        document.getElementById(`div-error-product-child-attr`).scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    } else if (response.data.error_product_child_empty) {
                        let errorRow = [];

                        for (const [key, value] of Object.entries(response.data.error_product_child_empty)) {
                            errorRow.push(value);
                        }

                        $('#div-error-product-child-empty').html(`<p class="text-danger">Dòng ${errorRow.join(',')} đang bỏ trống các trường bắt buộc</p>`)
                    } else if (response.data.error_product_child_empty_row) {
                        alert(response.data.error_product_child_empty_row);
                    }
                }
            }).catch(function (err) {
                let mess_errors = err.response.data.errors;
                let scroll_flag = false;
                $.LoadingOverlay('hide');
                $('.error-text').text('');

                Object.keys(mess_errors).forEach(function (key) {
                    $(`#${key}-error`).show();

                    if (!scroll_flag) {
                        scroll_flag = true;

                        document.getElementById(`${key}-error`).scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }

                    $(`#${key}-error`).text(mess_errors[key]);
                });
            });
        });
    });
</script>
