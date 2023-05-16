<script src="{{ asset('lib/axios.min.js') }}"></script>
<style>
    .tag-error {
        margin-top: 10px;
    }
</style>
<script>
    $(document).ready(function () {
        var dataHtmlProductChildLisAttr = '';

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
                const id = $(this).attr('data-id');

                $(this).find('input').each(function () {
                    const name = $(this).attr('name');
                    $(this).attr('name', 'list_product_child_new[' + id + ']' + name);
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

                        $('.product-child-list-attr').html(data);
                        dataHtmlProductChildLisAttr = data;
                        reRenderNameListAttrProductChild();

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

        $('.js-example-basic-multiple').select2();

        $("#list_attribute").trigger("change");


        $('body').on('click', '.btn-delete-product-child', function () {
            const id = $(this).attr('data-id');

            if (id !== '') {
                $('#form-main').append(`<input type="hidden" value="${id}" name="product_child_id_delete[]">`);
            }

            $(this).parents('tr').remove();
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
