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
        <div class="row datatableRow">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $title }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! $dataTable->table([
                            'class' => 'datatable table table-bordered table-hover w-100',
                            ])
                        !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
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
            <script src="{{ url('js/reservations.js') }}"></script>
        @endsection

        @push('scripts')>
    {!! $dataTable->scripts() !!}
    @endpush

