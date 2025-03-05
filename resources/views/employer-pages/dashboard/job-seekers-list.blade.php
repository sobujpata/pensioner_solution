@extends('layout.sidenav-layout-emp')
@section('content')
    @include('employer-components.dashboard.job-seekers.seekers-list')
    {{-- @include('employer-components.dashboard.job-seekers.seekers-create')
    @include('employer-components.dashboard.job-seekers.seekers-approved')
    @include('employer-components.dashboard.job-seekers.seekers-update') --}}
@endsection
