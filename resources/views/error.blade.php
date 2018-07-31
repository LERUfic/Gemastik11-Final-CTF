@extends('layouts.base')
@section('title', 'Error')
@section('css')
	<style>
		.backbutton{
			width: 133px;
			background: #FFFFFF ;
			text-align: center;
			padding: 117px 0px;
		}
		.backbutton:hover{
			background-color: #E8E8E8;
		}
		.verline{
			border-left:2px solid #000000;
			height:344px;
		}
		.pesanerror{
			padding: 130px 0px;
			font-family: 'Trocchi', serif;
			font-size: 45px;
			color: #ff4a4a;
		}
	</style>
@endsection
@section('contents')
	<div class="row" style="margin-top:2%;">
		<div class="col-md-1"></div>
		<div class="col-md-1">
			<a href="javascript:history.back()">
				<div class="backbutton">
					<i class="fa fa-angle-double-left" style="font-size:120px;"></i>
				</div>
			</a>
		</div>
		<div class="col-md-3" style="margin-left: 2%">
			<img src="https://arek.its.ac.id/gemastik/images/gemastik.png">
		</div>
		<div class="col-md-1">
			<div class="verline"></div>
		</div>
		<div class="col-md-5">
			<div class="pesanerror">
				<p>
					@if (session('msg'))
			        		{{ session('msg') }}
					@endif
				</p>
			</div>
		</div>
	</div>
@endsection