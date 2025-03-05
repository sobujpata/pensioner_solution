@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.form-manage.form-list')
    @include('admin-components.form-manage.form-create')
    @include('admin-components.form-manage.form-update')
    @include('admin-components.form-manage.form-delete')
@endsection
