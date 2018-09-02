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
				<h1>{{$data}}</h1>
				<span>Relawan Direkrut</span>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card bg-gradient-info text-white text-center">
			<div class="card-body">
				<h1>{{$total_pemilih}}</h1>
				<span>Jumlah Pemilih</span>
			</div>
		</div>
	</div>
</div>
@endsection