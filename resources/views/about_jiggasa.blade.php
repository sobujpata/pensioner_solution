@extends('layout.app2')
@section('content')
    <div class="container pt-md-7">
        <div class="row">
            <div class="col-12"><h4 id="welfare" class="gen-inst-emp-header transform_header">{!!$login_infos->title!!}</h4></div>
            <div class="col-md-12">{!!$login_infos->description!!}</div>
        </div>
    </div>
@endsection
