$(function () {
    // Avoiding CSRF_TOKEN error in ajax request
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).on('click', '.deleteRoomBtn', function (e) {
    const url = $(this).data('url');
    const datatableId = $(this).data('datatable');

    Swal.fire({
        title: 'Are you sure?',
        // text: "You won't be able to revert this!",
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
