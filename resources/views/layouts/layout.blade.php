
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="A trial run">
  <meta name="author" content="Daniel of England">
  <link rel="icon" href="../../../../favicon.ico">

  <title>It's this tab guys</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="/css/blog.css" rel="stylesheet">
  <link  href="/css/cropper.min.css" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>

<body>

    @include ('layouts.nav')

    @if ($flash = session('message'))
        <div id="flash-message" class="alert alert-success" role="alert">
            {{ $flash }}
        </div>
    @endif

    <div class="blog-header">
        <div class="container">
          <a href="/"><h1 class="blog-title">Friend<sup><small style="font-size:9px">ly</small></sup>Face</h1></a>
          <p class="lead blog-description">After a quick tinker, Daniel tried to make it work (nav bar and all).</p>
      </div>
    </div>

    <div class="container">

        <div class="row">
            @yield ('content')

            @include ('layouts.sidebar')
        </div><!-- /.row -->
    </div><!-- /.container -->

    @include ('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="/js/cropper.js"></script>

    @stack('scripts')

</body>

</html>

