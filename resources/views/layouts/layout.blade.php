
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>It's this tab guys</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/blog.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

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
        <h1 class="blog-title">Friend<sup><small style="font-size:9px">ly</small></sup>Face</h1>
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

  </body>

</html>

