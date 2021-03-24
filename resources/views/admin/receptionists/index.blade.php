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
        <!-- New admin Modal -->
        <div class="modal fade" id="newReceptionist" data-datatable="#receptionistsDatatable" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 4px">
                    <div class="modal-body" style="padding:0">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title text-center mb-3">New Receptionist.</h3>
                            </div>

                            <ul class="error_msgs_alert" id="new_error_msgs_alert">

                            </ul>
                        <!-- /.box-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.receptionists.create') }}" data-datatable="#receptionistsDatatable" 
                                  style="padding: 5px 10px 30px" enctype='multipart/form-data'>
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Name"  required>
                                    </div> 

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="Email" required>
                                    </div> 

                                    <div class="form-group">
                                        <label for="national_id">National_ID</label>
                                        <input type="text" class="form-control" id="national_id" name="national_id"
                                               placeholder="National_id" required>
                                    </div> 

                                    <div class="form-group">
                                        <label for="avatar">Img</label>
                                        <input type="text" class="form-control" id="img" name="img"
                                               placeholder="Img" required>
                                    </div> 

                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile"
                                               placeholder="Mobile" required>
                                    </div> 

                                    
                                    <div class="form-group">
                                        <label for="mobile">Country</label>
                                        <input type="text" class="form-control" id="country" name="country"
                                               placeholder="country" required>
                                    </div> 

                                    <div class="form-group">
                                        <label for="gender" class="form-label d-block">Gender</label>
                                        <input type="radio" id="male" name="gender" value="male">
                                        <label for="male">Male</label><br>
                                        <input type="radio" id="female" name="gender" value="female">
                                        <label for="female">Female</label><br>                                                     
                                    </div>                                   
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

        <div class="row datatableRow">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $title }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <button class="btn btn-primary" id="newRoomBtn"><i class="fa fa-plus"></i> New Rceptionist</button>
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