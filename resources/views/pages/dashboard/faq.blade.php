@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.faq.faq-list')
    @include('admin-components.faq.faq-create')
    @include('admin-components.faq.faq-update')
    @include('admin-components.faq.faq-delete')
@endsection
