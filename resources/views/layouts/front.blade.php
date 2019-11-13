<!DOCTYPE html>
<html>
<head>
	<title>Web Forum</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
  <!-- <link rel="stylesheet" type="text/css" href="https://bootswatch.com/paper/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  @yield('styles')
</head>
<body>
	@include('layouts.partials.navbar')
<br><br>
  @yield('banner')


	<div class="container">

    @include('includes.messages')


<br>
    <div class="row">

        @section('category')
            @include('layouts.partials.categories')
        @show

          <div class="col-md-9">
            <div class="row content-heading"> <h4> @yield('heading') </h4></div>
            <div>
               @yield('content')
            </div>
          </div>
      </div>

    </div>


  <script
  src="https://code.jquery.com/jquery-3.4.0.min.js"
  integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
  crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <script src="{{ asset('js/main.js') }}"></script>

  @yield('script')
</body>
</html>
