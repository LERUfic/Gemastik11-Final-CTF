<html>
<head>
	<title>Register</title>
</head>
<body>
	<form action="{{Route('register.submit')}}" method="POST">
    	{{ csrf_field() }}
    	Username: <input type="text" name="username"><br>
    	Password: <input type="text" name="password"><br>
    	<br>
    	Login Type:<br>
    	<input type="radio" name="ttype" value="admin"> Admin<br>
  		<input type="radio" name="ttype" value="peserta"> Peserta<br>
  		<br>
  		<input type="submit">
	</form>
</body>
</html