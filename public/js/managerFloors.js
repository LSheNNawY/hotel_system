$(function () {
    // Avoiding CSRF_TOKEN error in ajax request
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.deleteManagerFloorBtn', function (e) {
        const url = $(this).data('url');
        const datatableId = $(this).data('datatable');

        console.log('clicked');

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
                        text: "Floor Deleted successfully!",
                        confirmButtonColor: '#28a745',
                    })
                    $(datatableId).DataTable().ajax.reload();
                }).catch(function () {
                    Swal.fire({
                        text: "Sorry, this floor is not empty",
                        confirmButtonColor: '#dd3333',
                    })
                })

            }
        })
    })//end delete

    //start update


    //end update

    // show add new floor modal
    $(document).on('click', '.newFloorBtn', function () {
        $('#newFloorModal').modal('show');
    })

    // create new modal ajax request
    $(document).on('click', '#confirmCreation', function (e) {
        const form = $("#newFloorForm");
        const url = form.attr('action');
        const datatable = form.data('datatable');
        const name = $('#name').val();

        // const data = {name}

        let ErrorMsgAlert = $("#new_error_msgs_alert");

        $.ajax({
            url: url,
            method: "POST",
            data: {name},
            statusCode: {
                500: function () {
                    Swal.fire({
                        title: 'Error adding floor, please try again later',
                        icon: 'error',
                        showCancelButton: true,
                        cancelButtonColor: '#dd3333',
                        cancelButtonText: 'Ok'
                    })
                },
                200: function () {
                    ErrorMsgAlert.html('');
                    form[0].reset();
                    $('#newFloorModal').modal('hide');
                    $(datatable).DataTable().ajax.reload();
                    setTimeout(function () {
                        Swal.fire({
                            icon: "success",
                            text: "Floor created successfully",
                            confirmButtonColor: '#28a745',
                        })
                    }, 500)

                },
                400: function (response) {
                    console.log(response.errors);
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

    // show edit floor modal
    $(document).on('click', '.updateManagerBtn', function (e) {
        const editUrl = $(this).data('url');
        const updateUrl = $(this).data('updateurl');
        const datatableId = $(this).data('datatable');

        $.ajax({
            url: editUrl,
            method: 'GET',
        }).then(function (data) {
            $('#editName').val(data.name)

            $('#editFloorForm').attr('action', updateUrl)

            $('#editFloorModal').modal('show');


        }).catch(function (error) {
            console.log(error)
        })
    })


    // edit floor modal ajax request
    $(document).on('click', '#confirmEdit', function (e) {
        const form = $("#editFloorForm"),
            url = form.attr('action'),
            datatable = form.data('datatable'),
            name = $('#editName').val(),

            data = {name}


        let ErrorMsgAlert = $("#edit_error_msgs_alert");

        $.ajax({
            url: url,
            method: "PUT",
            data: data,
            statusCode: {
                500: function () {
                    Swal.fire({
                        title: 'Error editing floor, please try again later',
                        icon: 'error',
                        showCancelButton: true,
                        cancelButtonColor: '#dd3333',
                        cancelButtonText: 'Ok'
                    })
                },
                200: function () {
                    $(datatable).DataTable().ajax.reload();
                    ErrorMsgAlert.html('');
                    form[0].reset();
                    $('#editFloorModal').modal('hide')


                    setTimeout(function () {
                        Swal.fire({
                            icon: "success",
                            text: "Floor updated successfully",
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

});
