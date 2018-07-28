<html>
<head>
	<title>Input Soal</title>
</head>
<body>
	<form action="{{Route('flag.createin')}}" method="POST">
    	{{ csrf_field() }}
    	soal_id: <input type="text" name="soal_id"><br>
    	team_id: <input type="text" name="team_id"><br>
    	flag_text: <input type="text" name="flag_text"><br>
  		<br>
  		<input type="submit">
	</form>
</body>
</html