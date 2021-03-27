@extends('layouts.dashboard.app')
@section('styleLinks')
    <link rel="stylesheet" type="text/css"
          href="{{ url('adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ url('adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" type="text/css"
          href="{{ url('adminLTE\plugins\datatables-buttons\css\buttons.bootstrap4.min.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('content')
    <div class="container pt-4">
        <div class="row d-flex justify-content-center justify-items-center mt-4 p-2">
            <form action="{{ route('clients.store') }}" method="post" class="col-4" id="makeReservationForm">
                @csrf
                <div class="form-group row">
                    <label for="roomNumber" class="col-sm-4 col-form-label">Room</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext text-muted" id="roomNumber"
                               value="{{ $room->id }}" name="room_id">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-4 col-form-label">Price</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext text-muted" id="price"
                               value="{{ $room->price }}"
                               name="price">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Accompany" class="col-sm-4 col-form-label">Accompany</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="accompanyNumber" name="accompany_number" min="1"
                               max="{{$room->capacity}}" value="1">
                    </div>
                </div>

                <div class="form-group row">
                    <button class="btn btn-primary btn-block" id="makeReservationBtn">Make A Reservation</button>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('scriptLinks')
    <script src="{{ url('adminLTE\plugins\datatables\jquery.dataTables.min.js') }}"></script>
    {{-- datatables bootstrap --}}
    <script src="{{ url('adminLTE\plugins\datatables-bs4\js\dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ url('adminLTE\plugins\datatables-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('adminLTE\plugins\datatables-responsive\js\responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ url('adminLTE\plugins\datatables-buttons\js\dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('') }}/vendor/datatables/buttons.server-side.js"></script>
    <script>
        $(function () {
            // Avoiding CSRF_TOKEN error in ajax request
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '#makeReservationBtn', function (e) {
                const url = $('#makeReservationForm').attr('action');
                const data = {
                    'room_id': $('#roomNumber').val(),
                    'price': $('#price').val(),
                    'accompany_number': $('#accompanyNumber').val()
                }
                let ErrorMsgAlert = $("#new_error_msgs_alert");

                $.ajax({
                    url: url,
                    method: "POST",
                    data: data,
                    statusCode: {
                        500: function () {
                            Swal.fire({
                                title: 'Error',
                                icon: 'error',
                                showCancelButton: true,
                                cancelButtonColor: '#dd3333',
                                cancelButtonText: 'Ok'
                            })
                        },
                        200: function () {
                            setTimeout(function () {
                                Swal.fire({
                                    icon: "success",
                                    text: "Successfully added your reservation",
                                    confirmButtonColor: '#28a745',
                                })
                            }, 500);
                            setTimeout(function (){
                                window.location.href="/clients"
                            }, 500);

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
        })

    </script>
@endsection
