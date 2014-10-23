@extends('authlayout')

@section('title')
Chat
@stop

@section('css')
<link rel="stylesheet" href="/css/search.css">
@stop

@section('js')
<script src="//static.opentok.com/webrtc/v2.2/js/opentok.min.js" ></script>
@stop

@section('content')
<div class="container">
	<div class="row equal">
		<div class="col-md-3" id="sidebar">
			<div class="border-right"></div>
			<div class="list-group" style="margin-top: 10px">
			@foreach($users as $user)
				@if ($user == $activeTalker)
				<div class="border-right"></div>
				<a href="{{ URL::route('chat', $user->code) }}" class="list-group-item active">{{{ $user->full_name }}}</a>
				@else
				<a href="{{ URL::route('chat', $user->code) }}" class="list-group-item" data-code="{{ $user->code }}">
					<span class="badge pull-right"></span>
					{{{ $user->full_name }}}
				</a>
				@endif
			@endforeach
			</div>
			@include('footer.copyright')
		</div>
		<div class="col-md-9" id="main-content">
			<div class="panel" id="chat" data-code="{{ $activeTalker->code }}"{{ Input::has('call') ? ' autocall' : '' }}>
				<div class="panel-heading">
					<span style="float: left">Chat</span> <a href="#" data-call-code="{{ $activeTalker->code }}">Call</a> | <a href="#" data-call-code="{{ $activeTalker->code }}" data-video-call="true">Video call</a>
				</div>
				<ul class="list-group" style="min-height: 400px">
					@foreach($messages as $message)
					<?php $sender = User::find($message->sender_id); ?>
					@include('messages.message')
					@endforeach
				</ul>
			</div>
			{{ Form::open(array('route' => array('chat', $activeTalker->code), 'role' => 'form', 'class' => 'row', 'style' => 'background-color: #f0f0f0', 'data-type' => 'ajax')) }}
			<div class="form-group col-md-10">
				<label class="sr-only" for="message-chat">Message</label>
				<textarea class="form-control" rows="5" id="message-chat" name="message"></textarea>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-default">Send</button>
			</div>
			{{ Form::close() }}
			@include('footer.menu')
		</div>
	</div>
</div>
@stop