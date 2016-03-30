@extends('layouts.app-admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('blog/css/modal.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        @include('includes.info-box')
        <div class="card">
            <header>
                <nav>
                    <ul>
                        <li><a class="btn" href="{{ route('admin.blog.create_post') }}">New Post</a></li>
                        <li><a class="btn" href="{{ route('admin.blog.index') }}">Show all Posts</a></li>
                    </ul>
                </nav>
            </header>
            <section>
                <ul>
                    @if(count($posts) == 0)
                        <li>No Posts</li>
                    @else
                        @foreach($posts as $post)
                            <li>
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
                            </li>
                        @endforeach
                    @endif
                </ul>
            </section>
        </div>
        <div class="card">
            <header>
                <nav>
                    <ul>
                        <li><a class="btn" href="#">Show all Messages</a></li>
                    </ul>
                </nav>
            </header>
            <section>
                <ul>
                    @if(count($contact_messages) == 0)
                        No Messages
                    @endif
                    @foreach($contact_messages as $message)
                    <li>
                        <article class="contact-message" data-message="{{ $message->body }}" data-id="{{ $message->id}}">
                            <div class="message-info">
                                <h3>{{ $message->subject }}</h3>
                                <span class="info">{{ $message->sender }} | {{ $message->created_at }}</span>
                            </div>
                            <div class="edit">
                                <nav>
                                    <ul>
                                        <li>
                                            <a class="nav-link" href="#">View</a>
                                        </li>
                                        <li>
                                            <a class="danger" href="#">Delete</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </article>
                    </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>
    <div class="row">
        <ul>
            @foreach($authors as $author)
                <li>{{ $author->name}} ({{$author->password}})</li>
            @endforeach
        </ul>
    </div>
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
