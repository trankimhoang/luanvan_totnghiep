<script src="{{ asset('lib/axios.min.js') }}"></script>
<style>
    .tag-error {
        margin-top: 10px;
    }
</style>
<script>
    $(document).ready(function () {
        $('#image').change(function (event) {
            $(".img-preview").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        });

        $('.js-example-basic-multiple').select2();

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
                console.log(response);

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
