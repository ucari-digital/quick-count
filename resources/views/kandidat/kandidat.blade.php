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
	Data Pasangan Calon
	</h3>
	<nav aria-label="breadcrumb">
		<ul class="breadcrumb">
			<li class="breadcrumb-item active" aria-current="page">
				<a href="{{url('kandidat/create')}}" class="btn btn-gradient-primary">Tambah</a>
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
				<table class="table dtable-r">
					<thead>
						<tr>
							<th></th>
							<th>Nama</th>
							<th>Partai Pengusung</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $item)
						<tr>
							<td></td>
							<td>{{$item->name}}</td>
							<td>{{$item->partai_pengusung}}</td>
							<td>
								<div class="btn-group">
									<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Aksi
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="{{url('kandidat/edit/'.$item->id)}}">Edit</a>
										<a class="dropdown-item" href="{{url('kandidat/hapus/'.$item->id)}}">Hapus</a>
									</div>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection