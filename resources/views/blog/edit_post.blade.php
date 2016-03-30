@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('blog/css/form.css') }}">
@endsection
@section('content')
	<div class="container">
	@include('includes.info-box')
		<form action="{{ route('admin.blog.post.update') }}" method="post">
			{{ csrf_field() }}
			<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
				<label for="title">Title</label>
				<input type="text" name="title" class="form-control" id="title" value="{{ old('title') ? old('title') : isset($post) ? $post->title : '' }}">
			</div>
			<div class="form-group">
				<label for="category_select">Add Categories</label>
				<select name="category_select" class="form-control" id="category_select" placeholder="Add Category">
					@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
				</select>
			</div>
			<button type="button" class="btn">Add Category</button>
			<div class="added-categories">
				<ul>
					@foreach($post_categories as $post_category)
						<li><a href="#" data-id="{{ $post_category->id }}">{{ $post_category->name }}</a></li>
					@endforeach
				</ul>
			</div>
			<input type="hidden" name="categories" id="categories" value="{{ implode(',', $post_categories_ids) }}">
			<div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
				<label for="Body">Body</label>
				<textarea type="text" name="body" class="form-control" rows="12">{{ old('body') ? old('body') : isset($post) ? $post->body : '' }}</textarea>
			</div>
			<button type="submit" class="btn btn-primary">Save Post</button>
			<input type="hidden" name="post_id" value="{{ $post->id }}">
		</form>
	</div>
@endsection
@section('scripts')
	<script src="{{ asset('blog/js/posts.js') }}"></script>
@endsection