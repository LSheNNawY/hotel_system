$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.deleteBtn', function (e) {
        const url = $(this).data('url');
        const datatableId = $(this).data('datatable');

        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#dd3333',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                // ajax request for delete
                $.ajax({
                    url: url,
                    method: 'DELETE',
                }).then(function (data) {
                    Swal.fire({
                        text: "Receptionist Deleted successfully!",
                        confirmButtonColor: '#28a745',
                    })
                    $(datatableId).DataTable().ajax.reload();
                }).catch(function () {
                    Swal.fire({
                        text: "Error deleting Receptionist`",
                        confirmButtonColor: '#dd3333',
                    })
                })

            }
        })
    })

    $(document).on('click', '.newReceptionistBtn', function () {
        $('#newModal').modal('show');
    })

    $(document).on('click', '#confirmCreation', function (e) {
        const form = $("#newForm");
        const url = form.attr('action');

        const datatable = form.data('datatable');

        let ErrorMsgAlert = $("#new_error_msgs_alert");

        $.ajax({
            url: url,
            method: "POST",
            data: new FormData(form[0]),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            statusCode: {
                500: function () {
                    Swal.fire({
                        title: 'Error adding receptionist, please try again later',
                        icon: 'error',
                        showCancelButton: true,
                        cancelButtonColor: '#dd3333',
                        cancelButtonText: 'Ok'
                    })
                },
                200: function () {
                    ErrorMsgAlert.html('');
                    form[0].reset();
                    $('#newModal').modal('hide')
                    $(datatable).DataTable().ajax.reload();

                    setTimeout(function () {
                        Swal.fire({
                            icon: "success",
                            text: "Receptionist created successfully",
                            confirmButtonColor: '#28a745',
                        })
                    }, 500)
                },
                400: function (response) {
                    if (response.responseJSON.errors != undefined) {
                        error_msgs = '';
                        $.each(response.responseJSON.errors, function (key, val) {
                            error_msgs += `<li class="text-danger"><h5> ${val[0]} </h5></li>`;
                        });

                        ErrorMsgAlert.html(error_msgs);
                    }
                }
            },
        })
    })


    // show edit room modal
    $(document).on('click', '.updateBtn', function (e) {

        const editUrl = $(this).data('url'),
            updateUrl = $(this).data('updateurl'),
            datatableId = $(this).data('datatable');


        $.ajax({
            url: editUrl,
            method: 'GET',

        }).then(function (data) {
            data.gender == 'female' ? $('#femalee').attr('checked', 'checked') : $('#malee').attr('checked', 'checked')
            $('#editName').val(data.name)
            $('#editEmail').val(data.email)
            $('#editNational_id').val(data.national_id)
            //$('#editAvatar').val(data.avatar)
            $('#editMobile').val(data.mobile)
            $('#editCountry').val(data.country)
            $('#store_img').html(`<img src='/storage/images/${data.avatar}' width='100' class='img-thumbnail'/>`)
            $('#editForm').attr('action', updateUrl)
            $('#editModal').modal('show');

        }).catch(function (error) {
            console.log(error)
        })
    })

// edit receptionist modal ajax request
    $(document).on('click', '#confirmEdit', function (e) {
        const form = $("#editForm"),
            url = form.attr('action'),
            datatable = form.data('datatable'),
            name = $('#editName').val(),
            email = $('#editEmail').val(),
            national_id = $('#editNational_id').val(),
            avatar = $('#editAvatar').val();
        mobile = $('#editMobile').val(),
            country = $('#editCountry').val();

        const data = {name, email, national_id, mobile, country}

        let ErrorMsgAlert = $("#edit_error_msgs_alert");

        $.ajax({
            url: url,
            method: "PUT",
            data: data,
            // dataType:'JSON',
            // contentType:false,
            // cache:false,
            // processData:false,
            statusCode: {
                500: function () {
                    Swal.fire({
                        title: 'Error editing receptionist, please try again later',
                        icon: 'error',
                        showCancelButton: true,
                        cancelButtonColor: '#dd3333',
                        cancelButtonText: 'Ok'
                    })
                },
                200: function (data) {
                    ErrorMsgAlert.html('');
                    form[0].reset();
                    $('#editModal').modal('hide')
                    $(datatable).DataTable().ajax.reload();

                    setTimeout(function () {
                        Swal.fire({
                            icon: "success",
                            text: "Receptionist updated successfully",
                            confirmButtonColor: '#28a745',
                        })
                    }, 500)
                },
                400: function (response) {
                    // check if there are error msgs.
                    if (response.responseJSON.errors != undefined) {
                        error_msgs = '';
                        $.each(response.responseJSON.errors, function (key, val) {
                            error_msgs += `<li class="text-danger"><h5> ${val[0]} </h5></li>`;
                        });

                        ErrorMsgAlert.html(error_msgs);
                    }
                }
            },
        })
    })


    $(document).on('click', '.banBtn', function () {
        const url = $(this).data('url');
        const datatable = $(this).data('datatable');

        $.ajax({
            url,
            method: 'PUT',
            'data': {
                status: 'ban'
            }
        }).then(function (data) {
            $(datatable).DataTable().ajax.reload();
        })
    });

    $(document).on('click', '.unbanBtn', function () {
        const url = $(this).data('url');
        const datatable = $(this).data('datatable');

        $.ajax({
            url,
            method: "PUT",
            data: {
                status: 'unban'
            }
        }).then(function (data) {
            $(datatable).DataTable().ajax.reload();
        })

    });


});

