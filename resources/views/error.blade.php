<html>
<head>
	<title>Errors</title>
</head>
<body>
	<p>
		@if (session('msg'))
        		{{ session('msg') }}
		@endif
	</p>
</body>
</html