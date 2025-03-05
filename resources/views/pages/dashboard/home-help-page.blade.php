@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.home-pages-manage.home-help-list')
    @include('admin-components.home-pages-manage.home-help-create')
    @include('admin-components.home-pages-manage.home-help-update')
    @include('admin-components.home-pages-manage.home-help-delete')
@endsection
