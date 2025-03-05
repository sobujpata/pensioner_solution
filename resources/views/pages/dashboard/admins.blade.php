@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.admin-menage.admin-list')
    @include('admin-components.admin-menage.admin-edit')
    @include('admin-components.admin-menage.admin-create')
    @include('admin-components.admin-menage.admin-delete')
    @include('admin-components.admin-menage.pass-update')
@endsection

