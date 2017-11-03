@extends ('layouts.layout')

@section ('content')
<div class="col-sm-8 blog-main">
    <h1>Profile Settings</h1>
    <hr>

    <form method="POST" action="/profiles/settings/change-username">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="username">Change Username:</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" ></input>
        </div>

        <div class="form-group">
            <label for="password">Enter Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a class="btn btn-secondary" href="/profiles/settings">Cancel</a>
        </div>
        @include ('layouts.errors')
    </form>
</div>
@endsection