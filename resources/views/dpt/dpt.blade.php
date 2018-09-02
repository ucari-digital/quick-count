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
	Data DPT
	</h3>
	<nav aria-label="breadcrumb">
		<ul class="breadcrumb">
			<li class="breadcrumb-item active" aria-current="page">
				<a href="{{url('dpt/import')}}" class="btn btn-gradient-primary">Import Data DPT</a>
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
				<div class="table-responsive">
					<table class="table dtable-r">
						<thead>
							<tr>
								<th></th>
								<th>Nama</th>
								<th>Jumlah DPT</th>
								<th>Lihat Detail</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $item)
							<tr>
								<td></td>
								<td>{{$item->name}}</td>
								<td>{{$item->dpt}}</td>
								<td>
									<a href="{{url('dpt/'.$url.'/'.$item->id)}}" class="btn btn-primary">Lihat Detail</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection