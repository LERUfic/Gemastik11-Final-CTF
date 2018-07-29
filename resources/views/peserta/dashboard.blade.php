@extends('layouts.base')
@section('title', 'Dashboard Peserta')
@section('contents')
	<div class="row" style="margin-top:5%;">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="row">
			  <div class="col-md-3">
			    <div class="card">
			      <div class="card-body">
			        <h5 class="card-title"><b>Let's Play</b></h5>
			        <p class="card-text">Submit your Flag Here!</p>
			        <a href="{{ Route('flag.game') }}" class="btn btn-primary">Start</a>
			      </div>
			    </div>
			  </div>
			    </div>
			  </div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
@endsection