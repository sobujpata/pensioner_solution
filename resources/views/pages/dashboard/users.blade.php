@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.users-menage.users-list')
    @include('admin-components.users-menage.users-update')
    @include('admin-components.users-menage.pass-update')
    @include('admin-components.users-menage.user-approved')
    @include('admin-components.users-menage.user-delete')
@endsection
