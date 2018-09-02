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
	Data Anggota DPT
	</h3>
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
								<th>NIK</th>
								<th>NKK</th>
								<th>Nama</th>
								<th>TPT Lahir</th>
								<th>Tgl Lahir</th>
								<th>Umur</th>
								<th>Jenis Kelamin</th>
								<th>RT / RW</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $item)
							<tr>
								<td></td>
								<td>{{$item->no_ktp}}</td>
								<td>{{$item->no_kartu_keluarga}}</td>
								<td>{{$item->name}}</td>
								<td>{{explode(',', $item->ttl)[0]}}</td>
								<td>{{App\Helper\TimeFormat::id(explode(',', $item->ttl)[1])}}</td>
								<td>{{App\Helper\TimeFormat::age(explode(',', $item->ttl)[1])}}</td>
								<td>{{$item->jk}}</td>
								<td>{{$item->rtrw}}</td>
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
@section('footer')
@endsection