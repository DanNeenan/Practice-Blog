@extends ('layouts.layout')

@section ('content')
<div class="col-sm-8 blog-main">
    <h1>Profile Settings</h1>
    <hr>

    <form method="POST" action="/profiles/settings/delete-account">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <div class="form-group">
            <label for="password">Enter Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
                <label for="password_confirmation">Password Confirmation:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-secondary">Delete Account</button>

            <a class="btn btn-secondary" href="/profiles/settings">Cancel</a>
        </div>
        @include ('layouts.errors')
    </form>
</div>
@endsection
