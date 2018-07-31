<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Gemastik 11 - @yield('title')</title>
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ URL::asset('css/custom.min.css') }}">
</head>
  <body>
	 <nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="{{ Route('admin.dashboard') }}">Gemastik 11</a>
	    </div>
	    {{-- <ul class="nav navbar-nav">
	      <li class="active"><a href="#">Home</a></li>
	      <li><a href="#">Page 1</a></li>
	      <li><a href="#">Page 2</a></li>
	    </ul> --}}
	    <ul class="nav navbar-nav navbar-right">
	      <li><a href="{{ Route('login.logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	    </ul>
	  </div>
	</nav> 

    <header>
      <center>
          <h1><b><font>Keamanan Jaringan & Sistem Informasi</font></b></h1>
      </center>
      <hr size="20" style="width:70%; text-align:center;">
	</header>

    <div class="content">
		@yield('contents')
	</div>

    <hr>

    <footer style="padding-left:1.5%; position: fixed; left: 0; bottom: 0; width: 100%;">
      <div class="pull-right hidden-xs" style="padding-right:1.5%;">
        <b>Version</b> 0.0.1
      </div>
        <strong>Copyright &copy; 2018 <a href="https://ajk.if.its.ac.id">@JK</a>.</strong> All rights
        reserved.
		</footer>

    <script src="{{ URL::asset('js/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/app2.min.js') }}"></script>
    @yield('js')
  </body>
</html>