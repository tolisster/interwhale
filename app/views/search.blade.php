@extends('authlayout')

@section('content')
@foreach($users as $user)
<p>{{{ $user->full_name }}}</p>
@endforeach
@stop