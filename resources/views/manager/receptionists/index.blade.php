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
    <style type="text/css">
        .datatableRow > div {
            margin: auto;
        }
        .datatableRow .box {
            background-color: #FFFFFF;
            padding: 20px;
            text-align: center;
        }
        .dt-buttons {
            padding: 10px;
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
        <div class="modal fade" id="newModal"  data-datatable="#ManagerDatatable" tabindex="-1" role="dialog"
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
                            <form  action="{{ route('manager.receptionists.store') }}" data-datatable="#ManagerDatatable"
                                  style="padding: 5px 10px 30px" enctype='multipart/form-data' id="newForm" >
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
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Password" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="national_id">National_ID</label>
                                        <input type="text" class="form-control" id="national_id" name="national_id"
                                               placeholder="National_id" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="avatar">Img</label>
                                        <input type="file" class="form-control-file" id="avatar" name="avatar"
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

        <!-- Edit receptionist Modal -->
        <div class="modal fade" id="editModal" data-datatable="#ManagerDatatable" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 4px">
                    <div class="modal-body" style="padding:0">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title text-center mb-3">Edit Receptionist.</h3>
                            </div>

                            <ul class="error_msgs_alert" id="edit_error_msgs_alert">

                            </ul>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form data-datatable="#ManagerDatatable" id="editForm"
                                  style="padding: 5px 10px 30px">
                                  <div class="box-body">

                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="editName" name="name"
                                                placeholder="Name"  required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="editEmail" name="email"
                                                placeholder="Email" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="editPassword" name="password"
                                                placeholder="Password" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="national_id">National_ID</label>
                                            <input type="text" class="form-control" id="editNational_id" name="national_id"
                                                placeholder="National_id" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="avatar">Img</label>
                                            <input type="file" class="form-control-file" id="editAvatar" name="avatar"
                                                placeholder="Img" required>
                                            <span id="store_img"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control" id="editMobile" name="mobile"
                                                placeholder="Mobile" required>
                                        </div>


                                        <div class="form-group">
                                            <label for="mobile">Country</label>
                                            <input type="text" class="form-control" id="editCountry" name="country"
                                                placeholder="country" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="gender" class="form-label d-block">Gender</label>
                                            <input type="radio" id="malee" name="gender" value="male">
                                            <label for="malee">Male</label><br>
                                            <input type="radio" id="femalee" name="gender" value="female">
                                            <label for="femalee">Female</label><br>
                                        </div>
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
            <div class="col-12 container">
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

    <script src="{{ url('adminLTE\plugins\datatables-buttons\js\dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('') }}/vendor/datatables/buttons.server-side.js"></script>

    <script src="{{ url('js/receptionist.js') }}"></script>
@endsection

@push('scripts')>
{!! $dataTable->scripts() !!}
@endpush
