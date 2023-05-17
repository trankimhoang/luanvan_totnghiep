<script src="{{ asset('lib/axios.min.js') }}"></script>
<style>
    .tag-error {
        margin-top: 10px;
    }
</style>
<script>
    $(document).ready(function () {
        var dataHtmlProductChildLisAttr = '';
        const listAttrValueForListProductChild = @json($listAttrValueForListProductChild ?? []);

        @if(empty($product))
            $('#btn-add-product-child-new').prop('disabled', true);
        @endif
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

            if (listAttrSelect.length > 0) {
                $.LoadingOverlay('show');
                let countSuccess = 0;

                $.ajax({
                    method: 'get',
                    url: @json(route('admin.renderAttribute')),
                    data: {
                        attribute_ids: listAttrSelect,
                        product_id: $('#id').val()
                    },
                    success: function (data) {
                        countSuccess++;
                        $('#div_list_attribute').html(data);

                        if (countSuccess === 2) {
                            $.LoadingOverlay('hide');
                        }
                    }
                });

                $.ajax({
                    method: 'get',
                    url: @json(route('admin.renderAttributeProductChild')),
                    data: {
                        attribute_ids: listAttrSelect,
                    },
                    success: function (data) {
                        countSuccess++;
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

                        if (countSuccess === 2) {
                            $.LoadingOverlay('hide');
                        }
                    }
                });

            }
        }

        $('#list_attribute').on('change', function (e) {
            renderAttrFieldParent();
        });

        $('body').on('change', '.input-attr-product-child', function () {
            const productId = $(this).parents('.product-child-list-attr').attr('data-id');
            const attrId = $(this).attr('data-id');
            listAttrValueForListProductChild[productId + '_' + attrId] = $(this).val();
        });

        $('.js-example-basic-multiple').select2();

        $("#list_attribute").trigger("change");


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
                } else if (response.data.error_product_exists) {
                    $('#div-error-product-child-attr').html('');
                    $.LoadingOverlay('hide');

                    console.log(response.data.error_product_exists);

                    for (const [key, value] of Object.entries(response.data.error_product_exists)) {
                        let errorRow = [];

                        value.forEach(function (item) {
                            const stt = $(`.product-child-list-attr[data-id='${item}']`).attr('stt');
                            errorRow.push(stt);
                        });

                        console.log(errorRow);

                        $('#div-error-product-child-attr').append(`<p class="text-danger">Dòng ${errorRow.join(',')} đang bị trùng danh sách thuộc tính</p>`)
                    }

                    document.getElementById(`div-error-product-child-attr`).scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
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
