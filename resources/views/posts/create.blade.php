@extends ('layouts.layout')

@section ('content')
<div class="col-sm-8 blog-main">
    <h1>Publish a Post</h1>
    <hr>

    <form method="POST" action="/posts" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="form-group">
            <label for="body">Body:</label>
            <textarea id="body" name="body" class="form-control" ></textarea>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" id="tag" name="tag" placeholder="Add your tags here, seperated by a comma">
        </div>

        <div class="form-group">
            <label>Upload Picture</label>
            <input type="file" class="form-control" id="post_image" name="post_image">
            <input type="hidden"  name="_token" value="{{ csrf_token() }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Publish!</button>
        </div>
        @include ('layouts.errors')
    </form>
</div>
@endsection
