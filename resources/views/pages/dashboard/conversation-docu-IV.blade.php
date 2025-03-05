@extends('layout.sidenav-layout')
@section('content')
    @include('admin-components.conversation.conversation-list-docu-IV')
    @include('admin-components.conversation.conversation-create')
    @include('admin-components.conversation.conversation-update')
    @include('admin-components.conversation.conversation-audio')
    @include('admin-components.conversation.conversation-delete')
@endsection
