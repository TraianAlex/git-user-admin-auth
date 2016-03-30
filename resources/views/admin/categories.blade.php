@extends('layouts.app-admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('blog/css/categories.css') }}">
@endsection
@section('content')
	<div class="container">
		<section id="category-admin">
			<form class="form-inline" action="" method="post">
				<div class="form-group">
					<label for="name">Category Name</label>
					<input type="text" class="form-control" name="name" id="name" placeholder="category name">
				</div>
				<button type="submit" class="btn">Create Category</button>
			</form>
		</section>
		<section class="list">
			@foreach($categories as $category)
				<article>
					<div class="category-info" data-id="{{ $category->id }}">
						<h3>{{ $category->name }}</h3>
					</div>
					<div class="edit">
						<nav>
						    <ul>
						        <li class="category-edit"><input type="text"</li>
							    <li><a href="#">Edit</a></li>
							    <li><a href="#" class="danger">Delete</a></li>
						    </ul>
						</nav>
					</div>
				</article>
			@endforeach
		</section>
		@if($categories->lastPage() > 1)
			<section class="pagination">
				@if($categories->currentPage() !== 1)
	                <a href="{{ $categories->previousPageUrl() }}"><span class="fa fa-caret-left"></span></a>
	            @endif
	            @if($categories->currentPage() !== $categories->lastPage() && $categories->hasPages())
	                <a href="{{ $categories->nextPageUrl() }}"><span class="fa fa-caret-right"></span></a>
	        @endif
			</section>
		@endif
	</div>
@endsection
@section('scripts')
	<script>
        var token = "{{ Session::token() }}";
    </script>
	<script src="{{ asset('blog/js/categories.js') }}"></script>
@endsection