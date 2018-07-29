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
			        <h5 class="card-title"><b>Buat User Baru</b></h5>
			        <p class="card-text">Buat User Admin atau Peserta di sini!</p>
			        <a href="{{ Route('register.view') }}" class="btn btn-primary">Add User</a>
			      </div>
			    </div>
			  </div>
			  <div class="col-md-3">
			    <div class="card">
			      <div class="card-body">
			        <h5 class="card-title"><b>Buat Soal</b></h5>
			        <p class="card-text">Buat Soal dan tentukan Poinnya di sini!</p>
			        <a href="{{ Route('soal.form') }}" class="btn btn-primary">Add Soal</a>
			      </div>
			    </div>
			  </div>
			  <div class="col-md-3">
			    <div class="card">
			      <div class="card-body">
			        <h5 class="card-title"><b>Tambahkan Flag</b></h5>
			        <p class="card-text">Tentukan flag tiap soal dan tiap user!</p>
			        <a href="{{ Route('flag.create') }}" class="btn btn-primary">Add Flag</a>
			      </div>
			    </div>
			  </div>
			  <div class="col-md-3">
			    <div class="card">
			      <div class="card-body">
			        <h5 class="card-title"><b>Dashboard</b></h5>
			        <p class="card-text">Tampilan score para pemain saat ini!</p>
			        <a href="{{ Route('flag.allscore') }}" class="btn btn-primary">Lihat</a>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
@endsection