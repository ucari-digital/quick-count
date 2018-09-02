@extends('component.dashboard_layout')
@php
$auth = App\Helper\Lib::auth();
@endphp
@section('breadcrumb')
<div class="page-header">
	<h3 class="page-title">
	<span class="page-title-icon bg-gradient-primary text-white mr-2">
		<i class="mdi mdi-home"></i>
	</span>
	Upload DPT
	</h3>
	<nav aria-label="breadcrumb">
		<ul class="breadcrumb">
			<li class="breadcrumb-item active" aria-current="page">
				<a href="{{url('dpt/download')}}" class="btn btn-gradient-primary">Download Template DPT</a>
			</li>
		</ul>
	</nav>
</div>
<div class="row">
	<div class="col-md-12">
		@if(session('status') == 'success')
			<div class="alert alert-success" role="alert">
				{{session('message')}}
			</div>
		@elseif(session('status') == 'failed')
			<div class="alert alert-danger" role="alert">
				{{session('message')}}
			</div>
		@endif
	</div>
</div>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<form action="{{url('dpt/upload')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="file" name="excel" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<button type="submit" href="{{url('')}}" class="btn btn-primary btn-submit">Upload</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection