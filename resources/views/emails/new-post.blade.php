<!DOCTYPE html>
<html>
<head>
    <title>Welcome!</title>
</head>

<body>
    <h1>
        Hello again {{ $user->name }}
        <p>{{ $post->user->username }} posted a new blog, go check it out!
            <a href="{{ url('posts') }}/{{ $post->id }}">{{ $post->title }}</a>
        </p>

    </h1>

</body>
</html>
