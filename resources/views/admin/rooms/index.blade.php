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
        <!-- New room Modal -->
        <div class="modal fade" id="newRoomModal" data-datatable="#roomsDatatable" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 4px">
                    <div class="modal-body" style="padding:0">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title text-center mb-3">New Room.</h3>
                            </div>

                            <ul class="error_msgs_alert" id="new_error_msgs_alert">

                            </ul>
                        <!-- /.box-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.rooms.store') }}" data-datatable="#roomsDatatable" id="newRoomForm"
                                  style="padding: 5px 10px 30px">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="capacity">Capacity</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity"
                                               placeholder="Capacity" min="1" max="6" required>
                                    </div> <!-- end of capacity-->

                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                               placeholder="Price" min="500" required>
                                    </div> <!-- end of price-->

                                    <div class="form-group">
                                        <label for="floor">Floor Number</label>
                                        <select name="floor" id="floor" class="form-control" name="floor">
                                            <option value="">Floor number</option>
                                            @foreach($floors as $floor)
                                                <option value="{{ $floor->id }}">{{ $floor->id }}</option>
                                            @endforeach
                                        </select>
                                    </div> <!-- end of floors-->
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="confirmCreation">Add</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Edit room Modal -->
        <div class="modal fade" id="editRoomModal" data-datatable="#roomsDatatable" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 4px">
                    <div class="modal-body" style="padding:0">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title text-center mb-3">Edit Room.</h3>
                            </div>

                            <ul class="error_msgs_alert" id="edit_error_msgs_alert">

                            </ul>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form action="" data-datatable="#roomsDatatable" id="editRoomForm"
                                  style="padding: 5px 10px 30px">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="capacity">Capacity</label>
                                        <input type="number" class="form-control" id="editCapacity" name="capacity"
                                               placeholder="Capacity" min="1" max="6" required>
                                    </div> <!-- end of capacity-->

                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" id="editPrice" name="price"
                                               placeholder="Price" min="500" required>
                                    </div> <!-- end of price-->

                                    <div class="form-group">
                                        <label for="editAvailability">Available</label>
                                        <select name="available" id="editAvailability" class="form-control">
                                            <option value=""></option>
                                            <option value="1">Available</option>
                                            <option value="0">Reserved</option>
                                        </select>
                                    </div> <!-- end of availability-->

                                    <div class="form-group">
                                        <label for="floor">Floor Number</label>
                                        <select name="floor" id="editFloor" class="form-control" name="floor">
                                            <option value="">Floor number</option>
                                            @foreach($floors as $floor)
                                                <option value="{{ $floor->id }}">{{ $floor->id }}</option>
                                            @endforeach
                                        </select>
                                    </div> <!-- end of floors-->

                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" id="confirmEdit">Edit</button>
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
                        <button class="btn btn-primary" id="newRoomBtn"><i class="fa fa-plus"></i> New Room</button>
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
