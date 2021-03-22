@extends('layouts.dashboard.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        {!! $dataTable->table() !!}
    </div>
</div>

    {!! $dataTable->scripts() !!}
 
</body>

</html>

@endsection
