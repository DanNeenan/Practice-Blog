@extends ('layouts.layout')

@section('content')
<div class="col-sm-8 blog-main">
    @foreach($posts as $post)
    @include('posts.post')
    @endforeach

    @if (count($posts) > 9)
    {{ $posts->links() }}
    @endif

</div>


@endsection
