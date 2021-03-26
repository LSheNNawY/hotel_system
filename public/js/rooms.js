$(function () {
    // Avoiding CSRF_TOKEN error in ajax request
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.deleteRoomBtn', function (e) {
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
                console.log("confirmed")
                // ajax request for delete
                $.ajax({
                    url: url,
                    method: 'DELETE',
                }).then(function (data) {
                    Swal.fire({
                        text: "Room Deleted successfully!",
                        confirmButtonColor: '#28a745',
                    })
                    $(datatableId).DataTable().ajax.reload();
                }).catch(function () {
                    Swal.fire({
                        text: "Error deleting room",
                        confirmButtonColor: '#dd3333',
                    })
                })

            }
        })
    })

    // show add new room modal
    $(document).on('click', '.newRoomBtn', function () {
        $('#newRoomModal').modal('show');
    })

    // create new modal ajax request
    $(document).on('click', '#confirmCreation', function (e) {
        const form = $("#newRoomForm");
        const url = form.attr('action');
        const datatable = form.data('datatable');
        const capacity = $('#capacity').val(),
            price = $('#price').val(),
            floor = $('#floor').val();

        const data = {capacity, price, floor}

        let ErrorMsgAlert = $("#new_error_msgs_alert");

        $.ajax({
            url: url,
            method: "POST",
            data: data,
            statusCode: {
                500: function () {
                    Swal.fire({
                        title: 'Error adding room, please try again later',
                        icon: 'error',
                        showCancelButton: true,
                        cancelButtonColor: '#dd3333',
                        cancelButtonText: 'Ok'
                    })
                },
                200: function () {
                    ErrorMsgAlert.html('');
                    form[0].reset();
                    $('#newRoomModal').modal('hide')
                    $(datatable).DataTable().ajax.reload();

                    setTimeout(function () {
                        Swal.fire({
                            icon: "success",
                            text: "Room created successfully",
                            confirmButtonColor: '#28a745',
                        })
                    }, 500)

                    console.log($(datatable));

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

    // show edit room modal
    $(document).on('click', '.updateRoomBtn', function (e) {
        const editUrl = $(this).data('url');
        const updateUrl = $(this).data('updateurl');
        const datatableId = $(this).data('datatable');

        $.ajax({
            url: editUrl,
            method: 'GET',
        }).then(function (data) {
            $('#editPrice').val(data.price)
            $('#editCapacity').val(data.capacity)
            $(`#editAvailability option[value=${data.available}]`).attr('selected', true)
            $(`#editFloor option[value=${data.floor_id}]`).attr('selected', true)

            $('#editRoomForm').attr('action', updateUrl)

            $('#editRoomModal').modal('show');


        }).catch(function (error) {
            console.log(error)
        })
    })


    // edit room modal ajax request
    $(document).on('click', '#confirmEdit', function (e) {
        const form = $("#editRoomForm"),
            url = form.attr('action'),
            datatable = form.data('datatable'),
            capacity = $('#editCapacity').val(),
            available = $('#editAvailability').val(),
            price = $('#editPrice').val(),
            floor = $('#editFloor').val();

        const data = {capacity, price, floor, available}

        let ErrorMsgAlert = $("#edit_error_msgs_alert");

        $.ajax({
            url: url,
            method: "PUT",
            data: data,
            statusCode: {
                500: function () {
                    Swal.fire({
                        title: 'Error editing room, please try again later',
                        icon: 'error',
                        showCancelButton: true,
                        cancelButtonColor: '#dd3333',
                        cancelButtonText: 'Ok'
                    })
                },
                200: function () {
                    ErrorMsgAlert.html('');
                    form[0].reset();
                    $('#editRoomModal').modal('hide')
                    $(datatable).DataTable().ajax.reload();

                    setTimeout(function () {
                        Swal.fire({
                            icon: "success",
                            text: "Room updated successfully",
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


    $(document).on('click', '.deleteRoomBtn', function (e) {
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
                console.log("confirmed")
                // ajax request for delete
                $.ajax({
                    url: url,
                    method: 'DELETE',
                }).then(function (data) {
                    Swal.fire({
                        text: "Room Deleted successfully!",
                        confirmButtonColor: '#28a745',
                    })
                    $(datatableId).DataTable().ajax.reload();
                }).catch(function () {
                    Swal.fire({
                        text: "Error deleting room",
                        confirmButtonColor: '#dd3333',
                    })
                })

            }
        })
    })

    // show add new room modal
    $(document).on('click', '#newRoomBtn', function () {
        $('#newRoomModal').modal('show');
    })

    // create new modal ajax request
    $(document).on('click', '#confirmCreation', function (e) {
        const form = $("#newRoomForm");
        const url = form.attr('url');
        const datatable = form.data('datatable');
        const capacity = $('#capacity').val(),
            price = $('#price').val(),
            floor = $('#floor').val();

        const data = {capacity, price, floor}

        let ErrorMsgAlert = $("#new_error_msgs_alert");

        $.ajax({
            url: url,
            method: "POST",
            data: data,
            statusCode: {
                500: function () {
                    Swal.fire({
                        title: 'Error adding room, please try again later',
                        icon: 'error',
                        showCancelButton: true,
                        cancelButtonColor: '#dd3333',
                        cancelButtonText: 'Ok'
                    })
                },
                200: function () {
                    ErrorMsgAlert.html('');
                    form[0].reset();
                    $('#newRoomModal').modal('hide')

                    setTimeout(function () {
                        Swal.fire({
                            icon: "success",
                            text: "Room created successfully",
                            confirmButtonColor: '#28a745',
                        })
                    }, 500, function () {
                        $(datatable).DataTable().ajax.reload();

                    })

                    console.log($(datatable));

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

});
