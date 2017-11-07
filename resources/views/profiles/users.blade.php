@extends ('layouts.layout')

@section ('content')
{{-- @if (!empty($users)) --}}
<div class="col-sm-8">
        <h6>Starting with:</h6>

        @foreach (range('A', 'Z') as $letter)
            <a href='/users/?letter={{ $letter }}' style="font-size: 28px;"> {{ $letter }} </a>
        @endforeach
        <a href='/users' style="font-size: 28px;">All Users</a>
</div>

<div class="col-sm-8">
    <h1>Users:</h1>

    <hr>
    <ul>

        @foreach ($users as $user)
        <div class="row" style="height:225px;">
            <li class="list-unstyled">
                <img src="/storage/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">

                <a href='/profiles/{{ $user->username }}'>
                    <h2>{{ $user->username }}</h2>
                </a>

                <p>{{ $user->about }}</p>

            </li>

        </div>
        @endforeach
        {{ $users->links() }}
    </ul>
</div>
{{-- @endif --}}
@endsection
