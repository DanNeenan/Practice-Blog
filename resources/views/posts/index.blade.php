@extends ('layouts.layout')

@section('content')
<div class="col-sm-8 blog-main">
    @foreach($posts as $post)
    @include('posts.post')
    @endforeach

    @if (request()->has('month') && request()->has('year'))
        @php
            $appends = ['month' => request('month'), 'year' => request('year')];
        @endphp
    @else
        @php
            $appends = [];
        @endphp
    @endif

    {{ $posts->appends($appends)->links() }}


</div>


@endsection
