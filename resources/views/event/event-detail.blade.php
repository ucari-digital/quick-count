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
	Pendataan Pra Event
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
								<th>Kota</th>
								<th>Kecamatan</th>
								<th>Kelurahan</th>
								<th>TPS</th>
								<th>Pilihan</th>
								<th>Jumlah Suara</th>
								<th>Total DPT</th>
								<th>Bukti</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $item)
							<tr>
								<td></td>
								<td>{{$item['kota']}}</td>
								<td>{{$item['kecamatan']}}</td>
								<td>{{$item['kelurahan']}}</td>
								<td>{{$item['tps']}}</td>
								<td>{{$item['pilihan']}}</td>
								<td>{{$item['jumlah_suara']}}</td>
								<td>{{$item['jumlah_dpt']}}</td>
								<td><img src="{{url(''.$item['bukti'])}}"></td>
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