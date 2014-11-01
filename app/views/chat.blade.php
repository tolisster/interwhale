@extends('authlayout')

@section('title')
Chat
@stop

@section('css')
<link rel="stylesheet" href="/css/chat.css">
@stop

@section('js')
<script src="//static.opentok.com/webrtc/v2.2/js/opentok.min.js" ></script>
@stop

@section('content')
<div class="container">
	<div class="row equal">
		<div class="col-md-3" id="sidebar">
			<div class="border-right"></div>
			<div class="title-dialogs">Dialogues {{ $users->count() }}</div>
			<ul class="nav nav-pills nav-stacked nav-dialogs">
			@foreach($users as $user)
				@if ($user->id == $activeTalker->id)
				<li class="active">
					<div class="border-right"></div>
					<a href="{{ URL::route('chat', $user->code) }}">
						<span class="bullet">&bull;</span>
						<span class="badge"></span>
						{{{ $user->full_name }}}
					</a>
				</li>
				@else
				<li>
					<a href="{{ URL::route('chat', $user->code) }}" data-code="{{ $user->code }}">
						<span class="badge"></span>
						{{{ $user->full_name }}}
					</a>
				</li>
				@endif
			@endforeach
			</ul>
			@include('footer.copyright')
		</div>
		<div class="col-md-9" id="main-content">
			<div class="panel panel-chat" data-code="{{ $activeTalker->code }}"{{ Input::has('call') ? ' autocall' : '' }}>
				<div class="panel-heading row">
					<div class="panel-title col-md-4">Chat with : <b>{{{ $activeTalker->full_name }}}</b></div>
					<div class="col-md-4 row text-center">
						<button type="button" class="btn btn-link" disabled="disabled" data-call-code="{{ $activeTalker->code }}">Call</button>
						<span class="solid-vertical-bar"> | </span>
						<button type="button" class="btn btn-link" disabled="disabled" data-call-code="{{ $activeTalker->code }}" data-video-call="true">Video call</button>
					</div>
				</div>
				<div class="list-group">
					@foreach($messages as $message)
					<?php $sender = User::find($message->sender_id); ?>
					<?php $associatedAlert = null;
					if ($message->alerts()->whereUserId(Auth::user()->id)->count() > 0)
						$associatedAlert = $message->alerts()->whereUserId(Auth::user()->id)->first(); ?>
					@include('messages.message')
					@endforeach
				</div>
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