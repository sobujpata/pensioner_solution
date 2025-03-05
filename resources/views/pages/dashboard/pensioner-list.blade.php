@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.pensioner.pensioner-list')
    @include('admin-components.pensioner.pensioner-create')
    @include('admin-components.pensioner.pensioner-update')
    @include('admin-components.pensioner.pensioner-delete')
@endsection
