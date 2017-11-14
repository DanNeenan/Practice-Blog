@extends('layouts.layout')

@section('content')
<div class="col-sm-8">
    <div class="row">
        <div class="col-sm-3 avatar_img">
            <img src="/storage/avatars/{{ $profileUser->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
        </div>
        <div class="col-sm-9">

            <h1>
                {{ $profileUser->username }}
            </h1>
            @if (Auth::check())
            @if (Auth::user()->id != $profileUser->id)
            <form method="POST" action="/profiles/{{ $profileUser->username }}/subscriptions">
                {!! csrf_field() !!}
                <input type="hidden" name="user_id" value="{{ $profileUser->id }}" />

                @if (Auth::user()->isSubscribed($profileUser))
                <input type="submit" class="btn btn-secondary" value="Subscribed" name="unsubscribe" />
                @else
                <input type="submit" class="btn btn-primary" value="Subscribe" name="subscribe" />
                @endif

            </form>
            @endif
            @endif


            <p>{{ $profileUser->name }} <small style="font-size:15px; color:grey;"> member since {{ $profileUser->created_at->diffForHumans() }}</small></p>

            @if (Auth::check())
                @if (Auth::user()->id === $profileUser->id)
                    <form enctype="multipart/form-data" action="/profiles/picture/{{ $profileUser->username }}" method="POST">
                        <label>Update Profile Picture</label>
                        <input type="file" name="avatar">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="pull-right btn btn-sm btn-secondary" style="float: right;">
                    </form>
                @endif
            @endif
            <hr>
        </div>
    </div>
    <div>
        <h2>

            @if (Auth::check() && Auth::user()->id == $profileUser->id)
            About You
            @else
            About {{ $profileUser->username }}
            @endif
        </h2>
        <p>{{ $profileUser->about }}</p>
        @if (Auth::check() && Auth::user()->id == $profileUser->id)
            <form method="POST" action="/profiles/{{ $profileUser->username }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="about">Update About you:</label>
                    <textarea id="about" name="about" class="form-control" ></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                @include ('layouts.errors')
            </form>
        @endif

        <div class="row">
            <div class="col-sm-6">
                <h2>{{ $profileUser->username }}'s Subscribers</h2>
                <div class="sidebar-module sidebar-module-inset column-styling">

                    @foreach ($profileUser->subscribers as $subscription)
                    <a href='/profiles/{{ $subscription->username }}'>
                        {{ $subscription->username }}
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="col-sm-6">
                <h2>{{ $profileUser->username }}'s Subscriptions</h2>
                <div class="sidebar-module sidebar-module-inset column-styling">

                    @foreach ($profileUser->subscribed as $subscription)
                    <a href='/profiles/{{ $subscription->username }}'>
                        {{ $subscription->username }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div>
        <h2>Posts</h2>

        <hr>

        @foreach ($posts as $post)

        <div class="blog-post">
            <h2 class="blog-post-title">
                <a href="/posts/{{ $post->id }}">
                    {{ $post->title }}
                </a>
            </h2>
            <p class="blog-post-meta">
                <a href="/profiles/{{ $post->user->username }}">{{ $post->user->username }}</a> on
                {{ $post->created_at->toFormattedDateString() }}
            </p>

            {{ $post->body }}

        </div>

        @endforeach
        {{ $posts->links() }}
    </div>
</div>
@endsection
