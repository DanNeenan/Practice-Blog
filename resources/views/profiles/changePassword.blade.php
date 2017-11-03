@extends ('layouts.layout')

@section ('content')
<div class="col-sm-8 blog-main">
    <h1>Profile Settings</h1>
    <hr>

    <form method="POST" action="/profiles/settings/change-password">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="password">Old Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="password_new">Choose New Password:</label>
            <input type="password" class="form-control" id="password_new" name="password_new">
        </div>

        <div class="form-group">
                <label for="password_new_confirmation">Password Confirmation:</label>
                <input type="password" class="form-control" id="password_new_confirmation" name="password_new_confirmation" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save Changes</button>

            <a class="btn btn-secondary" href="/profiles/settings">Cancel</a>
        </div>
        @include ('layouts.errors')
    </form>
</div>
@endsection