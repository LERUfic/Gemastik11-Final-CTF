<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Final Gemastik 11</title>
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ URL::asset('css/custom.min.css') }}">
</head>
{{-- <body class="skin-black-light" style="background-color:#f9f9f9;"> --}}
  <body class="skin-black-light" style="background-color:#013880;">
    <header>
      <center>
          <img src="https://arek.its.ac.id/gemastik/images/gemastikwhite.png" height="125" style="padding-top:1.5%;">
          <br>
          <h1><b><font color="#ffffff">Keamanan Jaringan & Sistem Informasi</font></b></h1>
      </center>
      <hr size="20" style="width:70%; text-align:center;">
		</header>

    <div class="content">
      <div class="login-box" style="margin-top:0%;">
        <div class="login-box-body">
          <form action="{{Route('login.submit')}}" method="POST">
            {{ csrf_field() }}
            @if(session('errors'))
              <div class="alert alert-danger">
                {{session('errors')->first('loginfailed')}}
              </div>
            @endif
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="username" name="username">
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="password" name="password">
            </div>
            <div class="row">
              <div class="col-xs-8">
              </div>
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
            </div>
          </form>
        </div>
      </div>
		</div>

    <hr>

    <footer style="padding-left:1.5%;">
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
  </body>
</html>