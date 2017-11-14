<!DOCTYPE html>
<html>
<head>
    <title>You've got a new subscriber!</title>
</head>

<body>
    <h1>
        Hello again {{ $user->name }}!

    </h1>
    <p>The user <a href='http://blog.dev/profiles/{{ auth()->user()->username }}'>{{ auth()->user()->username }}</a> subscribed to your blog!</p>
    <p>Post more and gain more subscribers!</p>

</body>
</html>
