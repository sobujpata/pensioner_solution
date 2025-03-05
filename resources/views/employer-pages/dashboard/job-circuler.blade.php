@extends('layout.sidenav-layout-emp')
@section('content')
    @include('employer-components.dashboard.job-circuler.circuler-list')
    @include('employer-components.dashboard.job-circuler.circuler-create')
    @include('employer-components.dashboard.job-circuler.circuler-approved')
    @include('employer-components.dashboard.job-circuler.circuler-update')
@endsection
