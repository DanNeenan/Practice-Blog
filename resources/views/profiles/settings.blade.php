@extends ('layouts.layout')

@section ('content')
<div class="col-sm-8 blog-main">
    <div class="row">
        <div class="col-sm-3">
            <img src="/storage/avatars/{{ Auth::user()->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
        </div>
        <div class="col-sm-9">
            <h1>{{ Auth::user()->username }} Profile Settings</h1>
        </div>


    </div>

    <hr>
    <h3>Username:</h3>
    <p>{{ Auth::user()->username }}</p>

    <div class="form-group">
        <a style="color:#eee;" class="btn btn-secondary" href="/profiles/settings/change-username">Change Username</a>
        <a style="color:#eee;" class="btn btn-secondary" href="/profiles/settings/change-password">Change Password</a>
    </div>

    <h3>Email:</h3>
    <p>{{ Auth::user()->email }}</p>

    <div class="form-group">
        <a style="color:#eee;" class="btn btn-secondary" href="/profiles/settings/change-email">Change Email</a>
    </div>

    <h3>Delete Account:</h3>

    <div class="form-group">
        <a style="color:#eee;" class="btn btn-secondary" href="/profiles/settings/delete-account">Delete Account</a>
    </div>

    @include ('layouts.errors')
</div>
@endsection
