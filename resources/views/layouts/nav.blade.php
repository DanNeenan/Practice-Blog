<div class="blog-masthead">
	<div class="container">
		<nav class="nav">
			{{-- <form method="GET">
				<input type="text" name="name">
				<input type="checkbox" name="hasCoffeeMachine" value="1"><span> Apply Filter</span>
			</form> --}}
			{{-- link works --}}
			<a class="nav-link" href="/">Home</a>
			{{-- link works --}}
			<a class="nav-link" href="/users">Users</a>
			{{-- <a href="/profiles/{{ $post->user->username }}">{{ $post->user->username }}</a> --}}
			@if (Auth::check())
			<a class="nav-link" href="/posts/create">Create Post</a>
			<a class="nav-link ml-auto" href="/profiles/{{ Auth::user()->username }}">Welcome {{ Auth::user()->name }}</a>
			<a class="nav-link" href='/profiles/settings'>Settings</a>
			<a class="nav-link" href='/logout'>Logout</a>
			@else
			<a class="nav-link ml-auto" href='/login'>Login</a>
			<a class="nav-link" href="/register">Register</a>
			@endif
		</nav>
	</div>
</div>
