@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.home-pages-manage.slider-list')
    @include('admin-components.home-pages-manage.slider-create')
    @include('admin-components.home-pages-manage.slider-update')
    @include('admin-components.home-pages-manage.slider-delete')
@endsection
