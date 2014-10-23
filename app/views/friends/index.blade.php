@extends('users')

@section('title')
Friends
@stop

@section('panel-heading')

@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

Friends

@stop
