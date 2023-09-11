<script type="text/javascript">

    $(document).on("submit", "form", function(event)
    {
        event.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            dataType: "JSON",
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function(xhr) {
                $('.error-message').text("");
            },
            success: function (response)
            {
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{route('articles')}}";
                    }
                })
            },
            error: function (xhr, desc, err)
            {
                var errors = xhr.responseJSON.errors;
                for (var field in errors) {
                    var errorMessage = errors[field][0];
                    $('#' + field + '_error').text(errorMessage);
                }

            }
        });    
    });

    function submitForm(url, redirect_url, id = '') {
        var formData = $('#ajax-form').serialize();
        var info = formData.split('&');
        info = info[1].split('=')[1];
        info = info.replace(/\%20/g, ' ');
        if(id != '') {
            var includeCustomHeader = true;
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            beforeSend: function(xhr) {
                if (includeCustomHeader) {
                    xhr.setRequestHeader('X-HTTP-Method-Override', 'PUT');
                }
                $('.error-message').text("");
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (url.indexOf("categories") >= 0) {
                    $('.am-sucess-msg').text(info+" category created sucessfully.")
                    $('#category_name').val("")
                } else {
                     $('.am-sucess-msg').text(info+" tag created sucessfully.")
                     $('#tag_name').val("")
                 }
                $('.em-error-msg').text("")
                
            },
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;
                for (var field in errors) {
                    var errorMessage = errors[field][0];
                    $('#' + field + '_error').text(errorMessage);
                }
                $('.am-sucess-msg').text("")
            }
        });
    }

    function updateForm(url, redirect_url, id = '') {
        var formData = $('#update-ajax-form').serialize();
        var info = formData.split('&');
        info = info[1].split('=')[1];
        info = info.replace(/\%20/g, ' ');
        if(id != '') {
            var includeCustomHeader = true;
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            beforeSend: function(xhr) {
                if (includeCustomHeader) {
                    xhr.setRequestHeader('X-HTTP-Method-Override', 'PUT');
                }
                $('.error-message').text("");
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (url.indexOf("categories") >= 0) {
                    $('.am-sucess-msg').text(info+" category updated sucessfully.")
                    $('#category_name').val("")
                } else {
                     $('.am-sucess-msg').text(info+" tag updated sucessfully.")
                     $('#tag_name').val("")
                 }
                $('.em-error-msg').text("")
                window.location.href = redirect_url

            },
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;
                for (var field in errors) {
                    var errorMessage = errors[field][0];
                    $('#' + field + '_error_edit').text(errorMessage);
                }
                $('.am-sucess-msg').text("")
            }
        });
    }

    $('#createBtn').click(function(){
        $('#tag_name').val("")
        $('#tag_name_error').text("")
        $('#category_name').val("")
        $('#category_name_error').text("")
        $('.am-sucess-msg').text("")
    })

    $('#category_name').keyup(function(){
        $('.am-sucess-msg').text("")
    })

    $('#tag_name').keyup(function(){
        $('.am-sucess-msg').text("")
    })

    $(function () {
        $('.select2').select2({
            allowClear: true,
        })
    });

    function deleteRecord(id, url, txt, table_id) {

        Swal.fire({
            title: 'Are you sure?',
            text: txt,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data:{
                        'id': id,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (response) {

                        const swalButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-lg btn-primary',
                            },
                            buttonsStyling: false
                        })
                        swalButtons.fire(
                            'Deleted!',
                            '',
                            'success'
                        )
                       $('#'+table_id).DataTable().draw();
                    },
                    error: function (xhr) {
                        if (xhr.status === 404) {
                            alert('Record not found');
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            }
        })
    }

    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

    tinymce.init({
        selector: '#description',
        height: 400,
        toolbar: [
            'undo redo | bold italic underline | fontselect fontsizeselect',
            'forecolor backcolor | alignleft aligncenter alignright alignfull | numlist bullist outdent indent | image'
          ],
        plugins: 'image',
        paste_data_images: true
    });
</script>