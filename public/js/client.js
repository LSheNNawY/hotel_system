$(function () {
    // Avoiding CSRF_TOKEN error in ajax request
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
})
