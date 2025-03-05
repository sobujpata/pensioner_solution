@extends('layout.app1')
@section('content')
<style>
    .card{
        padding: 2px !important;
    }
    .card-header{
        padding: 2px !important;
    }
    .card-body{
        padding: 2px !important;
    }
    .card-footer{
        padding: 2px !important;
    }
</style>
<div class="container" style="margin-top:55px; ">
    @include('components.conversation.submit-message')
    @include('components.conversation.get-message')
</div>
@endsection


