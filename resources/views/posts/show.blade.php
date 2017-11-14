@extends('layouts.layout')

@section('content')
<div class="col-sm-8 blog-main">
    <h1>{{ $post->title }}</h1>
    <p><a href="/profiles/{{ $post->user->username }}">{{ $post->user->username }}</a> on {{ $post->created_at->toFormattedDateString() }}</p>
    <hr>

    <div class="col-sm-12">
        @if (! empty($post->posts_image))
        <div>
            <img id="image" src="/storage/post_images/{{ $post->posts_image }}" style="width: 100%; height: 100%; float:center; margin-bottom: 10px; border-radius: 10%;">
        </div>
        @endif

        @if (Auth::check() && Auth::user()->id == $post->user->id)
        <form enctype="multipart/form-data" action="/posts/{{ $post->id }}/picture" method="POST">
            <label>Update Post Picture</label>
            <input type="file" name="post_image">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="pull-right btn btn-sm btn-secondary">
        </form>
        @endif
    </div>
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
            <div class="level">
                @foreach ($post->comments as $comment)
                    <li class="list-group-item">
                        <div>
                        @if ( !empty($comment->user->username))
                            <h5> <strong>{{ $comment->user->username }}</strong>
                        @else
                            <h5> <strong>Guest</strong>
                        @endif

                                {{ $comment->created_at->diffForHumans() }}: &nbsp;

                        </h5>
                            <a class="btn btn-default" {{ $comment->isFavourited() ? 'disabled' : '' }} href="/posts/{{ $post->id }}/comments/{{ $comment->id }}/favourites">
                                {{ $comment->favourites()->count() }} {{ str_plural('Favourite', $comment->favourites()->count()) }}
                            </a>
                        </div>
                        {{ $comment->body }}
                    </li>
                @endforeach
            </div>
        </ul>
    </div>

    <hr>

    <div class="card">
        <div class="card-block">
            <form method="POST" action="/posts/{{ $post->id }}/comments">
                {{ csrf_field() }}

                <div class="col-sm-12 form-group" style="padding-top: 15px;">
                    <textarea name="body" placeholder="Your comment here." class="form-control" required></textarea>

                    <div class="form-group" style="padding-top: 15px;">
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </div>
                </div>
            </form>

            @include('layouts.errors')
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(() => {
        var image = $('#image').cropper(image, {
            dragMode: 'move',
            aspectRatio: 16 / 9,
            autoCropArea: 0.65,
            restore: false,
            guides: false,
            center: false,
            highlight: false,
            cropBoxMovable: false,
            cropBoxResizable: false,
            toggleDragModeOnDblclick: false,
        });
    });
</script>
@endpush
