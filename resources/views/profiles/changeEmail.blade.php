@extends ('layouts.layout')

@section ('content')
<div class="col-sm-8 blog-main">
    <h1>Profile Settings</h1>
    <hr>

    <form method="POST" action="/profiles">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="email">Change Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" ></input>
        </div>

        <div class="form-group">
                <label for="email_confirmation">Email Confirmation:</label>
                <input type="email" class="form-control" id="email_confirmation" name="email_confirmation" required>
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