@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ URL::to('blog/css/main.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Welcome</div>

            <div class="panel-body">
                Your Application's Landing Page.
            </div>
        </div>
    </div>
</div>
@endsection
