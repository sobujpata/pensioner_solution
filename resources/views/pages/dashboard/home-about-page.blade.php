@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.home-pages-manage.home-about-list')
    @include('admin-components.home-pages-manage.home-about-create')
    @include('admin-components.home-pages-manage.home-about-update')
    @include('admin-components.home-pages-manage.home-about-delete')
@endsection
