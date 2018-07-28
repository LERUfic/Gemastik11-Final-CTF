<html>
<head>
	<title>Dashboard</title>
</head>
<body>
	<p>
		@if($peserta)
          	{{ $peserta }}
        @endif
	<br>
	<br>
        @if($soal)
          	{{ $soal }}
        @endif
	</p>

	@if($soal)
     	@foreach($soal as $s)
     		Soal {{ $s->soal_id }} <br>
     		@if($peserta)
     			@foreach($peserta as $p)
     				{{ $p->team_username}}
	     			<div>
	     				<form action="{{ Route('flag.gamein') }}" method="POST">
	     					{{ csrf_field() }}
	     					<input type="hidden" name="team" value="{{ $p->team_id }}">
	     					<input type="hidden" name="soal" value="{{ $s->soal_id }}">
	     					Input Flag: <input type="text" name="input_flag">
	     					<input type="submit">
	     				</form>
	     			</div>
	     			<br>
     			@endforeach
     		@endif
     		<br>
     		<hr>
		@endforeach
    @endif

</body>
</html