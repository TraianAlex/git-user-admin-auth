@extends('layouts.app-admin')

@section('content')
	<div class="container">
		<section id="post-admin">
			<a href="{{ route('admin.blog.post.edit', ['post_id' => $post->id]) }}">Edit Post</a>
			<a href="{{ route('admin.blog.post.delete', ['post_id' => $post->id]) }}">Delete Post</a>
		</section>
		<section class="post">
			<h2>{{ $post->title }}</h2>
			<span class="info">{{ $post->author }} | {{ $post->created_at }}</span>
			<p>{{ $post->body }}</p>
		</section>
	</div>
@endsection