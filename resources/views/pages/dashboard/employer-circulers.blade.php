@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.employer-circuler-manage.employer-circuler')
    @include('admin-components.employer-circuler-manage.employer-circuler-create')
    @include('admin-components.employer-circuler-manage.employer-circuler-update')
    @include('admin-components.employer-circuler-manage.employer-circuler-delete')
    @include('admin-components.employer-circuler-manage.circuler-approved-emp')
    @include('admin-components.employer-circuler-manage.circuler-approved-admin')
@endsection
