$(function () {
    // Avoiding CSRF_TOKEN error in ajax request
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', '.disapproveBtn', function (e) {
        const url = $(this).data('url');
        const datatableId = $(this).data('datatable');

        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#dd3333',
            confirmButtonText: 'Disapprove'
        }).then((result) => {
            if (result.value) {
                // ajax request for delete
                $.ajax({
                    url: url,
                    method: 'PUT',
                }).then(function (data) {
                    Swal.fire({
                        text: "Disapproved successfully!",
                        confirmButtonColor: '#28a745',
                    })
                    $(datatableId).DataTable().ajax.reload();
                }).catch(function () {
                    Swal.fire({
                        text: "Error",
                        confirmButtonColor: '#dd3333',
                    })
                })

            }
        })
    })


    // show edit room modal
    $(document).on('click', '.approveBtn', function (e) {
        const url = $(this).data('url');
        const datatableId = $(this).data('datatable');

        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#dd3333',
            confirmButtonText: 'Approve'
        }).then((result) => {
            if (result.value) {
                // ajax request for delete
                $.ajax({
                    url: url,
                    method: 'PUT',
                }).then(function (data) {

                    Swal.fire({
                        text: "Approved successfully!",
                        confirmButtonColor: '#28a745',
                    })
                    $(datatableId).DataTable().ajax.reload();
                }).catch(function () {
                    Swal.fire({
                        text: "Error",
                        confirmButtonColor: '#dd3333',
                    })
                })

            }
        })
    })
});

