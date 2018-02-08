<div class="blog-masthead">
	<div class="container">
		<nav class="nav">
			<a class="nav-link" href="/">Home</a>
			<a class="nav-link" href="/users">Users</a>

			@if (Auth::check())
				<a class="nav-link" href="/posts/create">Create Post</a>

				<form class="form-inline">
					<input type="search" name="Search">
					<button class="btn btn-outline-primary" type="submit">Seach</button>
				</form>

				<a class="nav-link ml-auto" href="/profiles/{{ Auth::user()->username }}">Welcome {{ Auth::user()->name }}</a>
				<a class="nav-link" href='/profiles/settings'>Settings</a>
				<a class="nav-link" href='/logout'>Logout</a>
			@else
				<form class="form-inline">
					<input type="search" name="Search">
					<button class="btn btn-outline-primary" type="submit">Seach</button>
				</form>

				<a class="nav-link ml-auto" href='/login'>Login</a>
				<a class="nav-link" href="/register">Register</a>
			@endif
		</nav>
	</div>
</div>
