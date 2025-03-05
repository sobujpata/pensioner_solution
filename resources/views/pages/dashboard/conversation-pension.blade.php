@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.conversation.conversation-list-pension')
    @include('admin-components.conversation.conversation-create')
    @include('admin-components.conversation.conversation-update')
    @include('admin-components.conversation.conversation-audio')
    @include('admin-components.conversation.conversation-delete')
@endsection
