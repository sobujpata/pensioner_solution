@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.home-pages-manage.home-tutorial-list')
    @include('admin-components.home-pages-manage.home-tutorial-create')
    @include('admin-components.home-pages-manage.home-tutorial-update')
    @include('admin-components.home-pages-manage.home-tutorial-delete')
@endsection
