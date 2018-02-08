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
        <div>
            @foreach ($users as $user)

            <div class="row">

                <li class="list-unstyled">
                    <img src="/storage/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">

                    <div class="col-sm-9">
                        @if (Auth::check())
                            @if (Auth::user()->id != $user->id)
                            <form method="POST" action="/profiles/{{ $user->username }}/subscriptions">
                                {!! csrf_field() !!}
                                <input type="hidden" name="user_id" value="{{ $user->id }}" />

                                @if (Auth::user()->isSubscribed($user))
                                    <input type="submit" class="btn btn-secondary" value="Subscribed" name="unsubscribe" />
                                @else
                                    <input type="submit" class="btn btn-primary" value="Subscribe" name="subscribe" />
                                @endif

                            </form>
                            @endif
                        @endif

                        <a href='/profiles/{{ $user->username }}'>
                            <h2>{{ $user->username }}</h2>
                        </a>

                        <p>{{ $user->about }}</p>
                    </div>
                </li>

            </div>

            <hr>

            @endforeach
        </div>
        {{ $users->links() }}
    </ul>
</div>
{{-- @endif --}}
@endsection
