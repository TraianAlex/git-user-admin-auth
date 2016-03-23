@extends('layouts.app')

@section('title')
    Treding quotes
@endsection

@section('styles')

@endsection

@section('content')
<div class="container">
    @if(!empty(Request::segment(2)))
        <section class="filter-bar">
            A filte has been set! <a href="{{ route('index') }}">Show all quotes</a>
        </section>
    @endif
    @if(count($errors) > 0)
        <section class="info-box fail">
            @foreach($errors->all() as $error)
                {{$error}}<br>
            @endforeach
        </section>
    @endif
    @if(Session::has('success'))
        <section class="info-box success">
            {{ Session::get('success') }}
        </section>
    @endif
    <section class="quotes">
        <h2>Latest Quotes</h2>
        @for($i = 0; $i < count($quotes); $i++)
            <article class="quote"<?php //{{ $i % 3 === 0 ? ' first-in-line' : (($i + 1) % 3 === 0 ? ' last-in-line' : '') }}?>>
                <div class="delete"><a href="{{ route('delete', ['quote_id' => $quotes[$i]->id]) }}">x</a></div>
                    {{ $quotes[$i]->quote }}
                <div class="info">Created by <a href="{{ route('index', ['author' => $quotes[$i]->user->name]) }}">{{$quotes[$i]->user->name}}</a> on {{$quotes[$i]->created_at}}</div>
            </article>
        @endfor
        <div class="pagination">
            @if($quotes->currentPage() !== 1)
                <a href="{{ $quotes->previousPageUrl() }}"><span class="fa fa-caret-left"></span></a>
            @endif
            @if($quotes->currentPage() !== $quotes->lastPage() && $quotes->hasPages())
                <a href="{{ $quotes->nextPageUrl() }}"><span class="fa fa-caret-right"></span></a>
            @endif
        </div>
    </section>
    <section class="edit-quote">
        <h2>Add a Quote</h2>
        <form method="post" action="{{ route('create') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="author">Name</label>
                <input type="text" class="form-control" name="author" id="author" placeholder="Jane">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="jondoe@example.com">
            </div>
            <div class="form-group">
                <label for="quote">Your Quote</label>
                <textarea class="form-control" name="quote" id="quote" rows="5" placeholder="Quote"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Quote</button>
        </form>
    </section>
</div>
@endsection
