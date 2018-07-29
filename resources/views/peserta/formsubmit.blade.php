@extends('layouts.base')
@section('title', 'Dashboard Peserta')
@section('contents')
	<div class="col-md-2"></div>
	<div class="col-md-8">
		@if($soal)
	     	@foreach($soal as $s)
	     		<h1>Soal {{ $s->soal_id }}</h1>
	     		<div class="row">
		     		@if($peserta)
		     			@foreach($peserta as $p)
			     				<div class="col-lg-3 col-xs-6">
			     					<div href="#" id="showModal{{ $p->team_id}}" data-user="{{ $p->team_id}}" data-soal="{{ $s->soal_id }}" data-toggle="modal" data-target="#modal{{ $p->team_id}}">
				     					<div class="small-box bg-aqua">
								        	<div class="inner">
								            	<h3>{{ $p->team_username }}</h3>
								              	<p>Poin {{ $s->soal_poin }}</p>
								            </div>
							       		</div>
						       		</div>
			     				</div>

		     					<div class="modal" id="modal{{ $p->team_id}}">
		     						<form action="{{ Route('flag.gamein') }}" method="POST">
									  <div class="modal-dialog">
									    <div class="modal-content">
								          <div class="modal-header">
								          	<button type="button" class="close" data-dismiss="modal">&times;</button>
								          	<h4 class="modal-title">Submit Your Flag!</h4>
								          </div>
									      <div class="modal-body">
												{{ csrf_field() }}
								      			<input type="hidden" name="team" value="{{ $p->team_id }}">
												<input type="hidden" name="soal" value="{{ $s->soal_id }}">
												<div class="form-group">
													<input class="form-control" type="text" name="input_flag" placeholder="GEMASTIK{ Insert Your Flag! }">
									      		</div>
									      </div>
									      <div class="modal-footer">
									        <input type="submit" value="Submit Flag" class="btn btn-primary btn-block">
									      </div>
									    </div>
									  </div>
								  </form>
								</div>
		     			@endforeach
		     		@endif
	     		</div>
	     		<br>
	     		<hr>
			@endforeach
	    @endif
	</div>
	<div class="col-md-2"></div>
@endsection