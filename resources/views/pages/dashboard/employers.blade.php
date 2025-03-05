@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.employers-menage.employers-list')
    @include('admin-components.employers-menage.employers-update')
    @include('admin-components.employers-menage.pass-update')
    @include('admin-components.employers-menage.employers-approved')
@endsection
