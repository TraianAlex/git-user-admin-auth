@extends('layouts.app')

@section('title')
	Blog Index
@endsection

@section('styles')
	<link rel="stylesheet" href="{{ URL::to('blog/css/main.css') }}">
@endsection

@section('content')
	@include('includes.info-box')
	@foreach($posts as $post)
		<article class="blog-post">
			<h3>{{ $post->title }}</h3>
			<span class="subtitle">{{ $post->user->name }} | {{ $post->created_at }}</span>
			<p>{{ $post->body }}</p>
			<a href="{{ route('blog.single', ['post_id' => $post->id, 'end' => 'blog']) }}">Read more</a>
		</article>
	@endforeach
	@if($posts->lastPage() > 1)
		<section class="pagination">
			@if($posts->currentPage() !== 1)
                <a href="{{ $posts->previousPageUrl() }}"><span class="fa fa-caret-left"></span></a>
            @endif
            @if($quotes->currentPage() !== $posts->lastPage() && $posts->hasPages())
                <a href="{{ $posts->nextPageUrl() }}"><span class="fa fa-caret-right"></span></a>
            @endif
		</section>
	@endif
@endsection