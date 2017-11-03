@extends ('layouts.layout')

@section ('content')
{{-- @if (!empty($users)) --}}
<div class="col-sm-8">
    <h1>Users:</h1>

    <hr>
    <ol>

        @foreach ($users as $user)
        <li>
            <a href='/profiles/{{ $user->username }}'>
                {{ $user->username }}
            </a>
        </li>
        @endforeach

    </ol>
</div>
{{-- @endif --}}
@endsection
