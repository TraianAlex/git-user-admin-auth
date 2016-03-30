@extends('layouts.app')

@section('title')
	Contact
@endsection

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ URL::to('blog/css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::to('blog/css/form.css') }}">
@endsection

@section('content')
	@include('includes.info-box')
	<form action="{{ route('contact.send') }}" method="post" id="contact-form">
		{{csrf_field()}}
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"placeholder="Jane Doe">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="email@example.com">
		</div>
		<div class="form-group">
			<label for="subject">Subject</label>
			<input type="text" class="form-control" name="subject" id="subject" value="{{ old('subject') }}" placeholder="Subject">
		</div>
		<div class="form-group">
			<label for="subject">Your Message</label>
			<textarea class="form-control" name="message" id="message" rows="10" placeholder="Your Message">{{ old('message') }}</textarea>
		</div>
		<button type="submit" class="btn btn-primary">Send Message</button>
	</form>
@endsection