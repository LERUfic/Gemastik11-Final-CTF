<html>
<head>
	<title>Input Soal</title>
</head>
<body>
	<form action="{{Route('soal.submit')}}" method="POST">
    	{{ csrf_field() }}
    	Deskripsi: <input type="text" name="soal_desc"><br>
    	Poin: <input type="text" name="soal_poin"><br>
  		<br>
  		<input type="submit">
	</form>
</body>
</html