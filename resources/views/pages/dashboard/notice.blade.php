@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.notice-manage.notice-list')
    @include('admin-components.notice-manage.notice-create')
    @include('admin-components.notice-manage.notice-update')
    @include('admin-components.notice-manage.notice-delete')
@endsection
