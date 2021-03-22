@extends('layouts.dashboard.app')

@section('styleLinks')
    <link rel="stylesheet" type="text/css"
          href="{{ url('adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ url('adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection

@section('content')
    <style type="text/css">
        .datatableRow > div {
            margin: auto;
        }

        .datatableRow .box {
            background-color: #FFFFFF;
            padding: 20px;
            text-align: center;
        }


        /*.newRoom {*/
        /*    float: right*/
        /*}*/

        /*.newRoom .fa {*/
        /*    margin-right: 4px*/
        /*}*/
    </style>
    <!-- Main content -->
    <section class="content">
        <section class="content-header">
            <h1> {{ $title }} </h1>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>

        </section>
        <!-- New admin Modal -->
        <div class="modal fade" id="newRoomModal" data-datatable="#roomsDatatable" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 4px">
                    <div class="modal-body" style="padding:0">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">New Room.</h3>
                            </div>

                        {{--                            <ul class="error_msgs_alert" id="new_error_msgs_alert">--}}

                        {{--                            </ul>--}}
                        <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" action="#" id="newRoomForm"
                                  style="padding: 5px 10px 30px">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="capacity">Capacity</label>
                                        <input type="number" class="form-control" id="capacity"
                                               placeholder="Capacity" min="1" max="6" required>
                                    </div> <!-- end of capacity-->

                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" id="price"
                                               placeholder="Capacity" min="500" required>
                                    </div> <!-- end of price-->

                                    <div class="form-group">
                                        <label for="floor">Floor</label>
                                        <select name="floor" id="floor">
                                            <option value="">#</option>
                                        </select>
                                    </div> <!-- end of floor-->
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="confirmCreation" data-new=""
                            {{--onclick="save('new')"--}}>Add
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row datatableRow">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $title }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! $dataTable->table([
                            'class' => 'datatable table table-bordered table-hover',
                            ])
                        !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@section('scriptLinks')
    {{-- datatables jquery --}}
    <script src="{{ url('adminLTE\plugins\datatables\jquery.dataTables.min.js') }}"></script>
    {{-- datatables bootstrap --}}
    <script src="{{ url('adminLTE\plugins\datatables-bs4\js\dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ url('adminLTE\plugins\datatables-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('adminLTE\plugins\datatables-responsive\js\responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ url('js/rooms.js') }}"></script>
@endsection

@push('scripts')>
{!! $dataTable->scripts() !!}
@endpush
