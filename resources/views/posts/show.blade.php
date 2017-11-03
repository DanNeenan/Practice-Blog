@extends('layouts.layout')

@section('content')
<div class="col-sm-8 blog-main">



    <h1>{{ $post->title }}</h1>
    <p><a href="/profiles/{{ $post->user->username }}">{{ $post->user->username }}</a> on {{ $post->created_at->toFormattedDateString() }}</p>
    <hr>
    <div>
    @if (Auth::check())
        @if (auth()->user()->username == $post->user->username)
            <form method="POST" action="/posts/{{ $post->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-link" style="color:#999; float: right;">Delete Post?</button>
            </form>
        @endif
    @endif
    </div>

    <hr>

    {{ $post->body }}
    <hr>

    @if (count($post->tags))
        <ul>
            @foreach ($post->tags as $tag)
                <li> {{ $tag->name }}</li>
            @endforeach
        </ul>
    @else
        No tags!
    @endif

    <div class="comments">
        <ul class="list-group">
            @foreach ($post->comments as $comment)
            <li class="list-group-item">
                <strong>
                    {{ $comment->created_at->diffForHumans() }}: &nbsp;
                </strong>
                {{ $comment->body }}
            </li>
            @endforeach
        </ul>
    </div>

    <hr>

    <div class="card">
        <div class="card-block">
            <form method="POST" action="/posts/{{ $post->id }}/comments">
                {{ csrf_field() }}

                <div class="form-group">
                    <textarea name="body" placeholder="Your comment here." class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add Comment</button>
                </div>
            </form>

            @include('layouts.errors')
        </div>
    </div>
</div>

@endsection
