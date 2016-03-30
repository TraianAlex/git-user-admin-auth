@extends('layouts.app-admin')

@section('title')
	Contact Messages
@endsection

@section('styles')
	<link rel="stylesheet" href="{{ URL::to('blog/css/modal.css') }}">
@endsection

@section('content')
	<div class="container">
		<section class="list">
			@if(count($contact_messages) == 0)
				No Messages
			@endif
			@foreach($contact_messages as $message)
				<article class="contact-message" data-message="{{ $message->body }}" data-id="{{ $message->id}}">
					<div class="category-info">
						<h3>{{ $message->subject }}</h3>
					</div>
					<div class="edit">
						<nav>
						    <ul>
						    	<li><a href="#">Show Message</a></li>
							    <li><a href="#" class="danger">Delete</a></li>
						    </ul>
						</nav>
					</div>
				</article>
			@endforeach
		</section>
		@if($contact_messages->lastPage() > 1)
			<section class="pagination">
				@if($contact_messages->currentPage() !== 1)
	                <a href="{{ $contact_messages->previousPageUrl() }}"><span class="fa fa-caret-left"></span></a>
	            @endif
	            @if($contact_messages->currentPage() !== $contact_messages->lastPage() && $contact_messages->hasPages())
	                <a href="{{ $contact_messages->nextPageUrl() }}"><span class="fa fa-caret-right"></span></a>
	        @endif
			</section>
		@endif
	</div>
	<div class="modal" id="contact-message-info">
	    <button class="btn" id="modal-close">Close</button>
	</div>
@endsection

@section('scripts')
	<script>
        var token = "{{ Session::token() }}";
    </script>
	<script src="{{ asset('blog/js/modal.js') }}"></script>
	<script src="{{ asset('blog/js/contact-messages.js') }}"></script>
@endsection