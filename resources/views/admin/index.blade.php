@extends('layouts.app-admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('blog/css/form.css') }}">
@endsection
@section('content')
<div class="container">
	@include('includes.info-box')
	<section id="post-admin">
		<a href="{{ route('admin.blog.create_post') }}" class="btn">New Post</a>
	</section>
	<section class="list">
        @if(count($posts) == 0)
            No Posts
        @else
            @foreach($posts as $post)
                <article>
                    <div class="post-info">
                        <h3>{{ $post->title }}</h3>
                        <span class="info">{{ $post->user->name }} | {{ $post->created_at }}</span>
                    </div>
                    <div class="edit">
                        <nav>
                            <ul>
                                <li>
                                    <a class="nav-link" href="{{ route('admin.blog.post', ['post_id' => $post->id, 'end' => 'admin']) }}">View Post</a>
                                </li>
                                <li>
                                    <a class="nav-link" href="{{ route('admin.blog.post.edit', ['post_id' => $post->id]) }}">Edit</a>
                                </li>
                                <li>
                                    <a class="danger" href="{{ route('admin.blog.post.delete', ['post_id' => $post->id]) }}">Delete</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </article>
            @endforeach
        @endif
	</section>
	@if($posts->lastPage() > 1)
		<section class="pagination">
			@if($posts->currentPage() !== 1)
                <a href="{{ $posts->previousPageUrl() }}"><span class="fa fa-caret-left"></span></a>
            @endif
            @if($posts->currentPage() !== $posts->lastPage() && $posts->hasPages())
                <a href="{{ $posts->nextPageUrl() }}"><span class="fa fa-caret-right"></span></a>
            @endif
		</section>
	@endif
</div>
@endsection