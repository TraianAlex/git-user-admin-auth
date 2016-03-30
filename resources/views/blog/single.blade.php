@extends('layouts.app')

@section('title')
	{{ $post->title }}
@endsection

@section('styles')
	<link rel="stylesheet" href="{{ URL::to('blog/css/main.css') }}">
@endsection

@section('content')
	<article>
		<h2>{{ $post->title }}</h2>
		<span class="subtitle">{{ $post->user->name }} | {{ $post->created_at }}</span>
		<p>{{ $post->body }}</p>
	</article>
@endsection