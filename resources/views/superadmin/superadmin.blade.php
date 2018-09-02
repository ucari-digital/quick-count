@extends('component.dashboard_layout')
@section('breadcrumb')
<div class="page-header">
	<h3 class="page-title">
	<span class="page-title-icon bg-gradient-primary text-white mr-2">
		<i class="mdi mdi-home"></i>
	</span>
	Dashboard
	</h3>
	<nav aria-label="breadcrumb">
		<ul class="breadcrumb">
			<li class="breadcrumb-item active" aria-current="page">
				<span></span>Overview
				<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
			</li>
		</ul>
	</nav>
</div>
@endsection
@section('content')
<div class="row">
	<div class="col-md-3">
		<div class="card bg-gradient-danger text-white text-center">
			<div class="card-body">
				<h1>{{$kabkota}}</h1>
				<span>Relawan Kab/Kota</span>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card bg-gradient-info text-white text-center">
			<div class="card-body">
				<h1>{{$kecamatan}}</h1>
				<span>Relawan Kec</span>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card bg-gradient-success text-white text-center">
			<div class="card-body">
				<h1>{{$kelurahan}}</h1>
				<span>Relawan Kel</span>
			</div>
		</div>
	</div>
</div>
@endsection