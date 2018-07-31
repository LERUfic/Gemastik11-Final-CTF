@extends('layouts.base')
@section('title', 'Scoreboard')
@section('contents')
	<div class="row" style="margin-top:5%;">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="inputcounter">
				<input type="text" id="jam">
				<input type="text" id="menit">
				<button id="startcounter">Countdown</button>
			</div>
			<div id="showcounter"></div>
			<div id="scoretable"></div>
		</div>
		<div class="col-md-2"></div>
	</div>
@endsection

@section('js')
<script>
	$('#startcounter').click(function(){
		$.get("{{ Route('game.start') }}", function(data){console.log("Game Dimulai")});
		getscoreboard();
		var jam = $("#jam").val();
		var menit = $("#menit").val();

		var totalwaktu = ((jam*60) + (menit*1))*60;
		setInterval(function(){
			totalwaktu = totalwaktu -1;
			var showdetik = Math.floor(totalwaktu % 60);
			var showmenit = Math.floor(totalwaktu/60) % 60;
			var showjam = Math.floor(totalwaktu/3600) % 60;

			$("#showcounter").html('<div id="showcounter">'+showjam+':'+showmenit+':'+showdetik+'</div>');
			
			if(totalwaktu == 0){
				console.log("Game Selesai")
  				window.location.href = "{{ Route('game.stop') }}";
			};
			console.log(totalwaktu);
		},1000);

		setInterval(getscoreboard,10000);
	});

	function getscoreboard(){
		console.log("Take data");
		$.get("{{ Route('flag.allscore') }}", function(data){
				var rank = 1;
				$("#scoretable").html('<div id="scoretables"><table class="table table-hover" id="tabless"><tr><th>Rank</th><th>Team</th><th>Poin</th><th>Last Submit</th></tr>');
				data.forEach(function(row){
					$('#tabless').append('<tr><td>'+rank+'</td><td>'+row.username+'</td><td>'+row.poin+'</td><td>'+row.last_submit+'</td></tr>');
					rank = rank +1;
				});
				$("#scoretable").append('</tables></div>');
			});
	}
</script>
@endsection