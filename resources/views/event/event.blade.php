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
	Pendataan Hasil Penghitungan Suara
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
								<th>{{$title}}</th>
								<th>Suara Pemilih</th>
								<th>Statistik Pemilih</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $item)
							<tr>
								<td></td>
								<td>{{$item['name']}}</td>
								<td>
									<table class="table table-striped">
										<tr>
											<td>Jumlah Pemilih</td>
											<td>{{$item['jumlah_pemilih']}}</td>
										</tr>
										<tr>
											<td>Suara Masuk</td>
											<td>{{$item['jumlah_suara']}}</td>
										</tr>
										<tr>
											<td>Suara Tidak Sah</td>
											<td>{{$item['jumlah_suara_tidak_sah']}}</td>
										</tr>
									</table>
								</td>
								<td>
									<div class="d-block" style="width: 200px; height: 200px;">
										<canvas class="myChart-{{$item['id']}}" width="100" height="100"></canvas>
									</div>
								</td>
								<td>
									@if($button_dispay == 'true')
									<a href="{{url($button_url.$item['id'])}}" class="btn btn-primary">{{$button_text}}</a>
									@endif
								</td>
							</tr>
							<script type="text/javascript">
								var ctx = document.getElementsByClassName("myChart-{{$item['id']}}");
								var myDoughnutChart = new Chart(ctx, {
							    	type: 'doughnut',
								    data: {
								      labels: {!! App\Helper\Lib::array2string($item['chart']['name'], true) !!},
								      datasets: [
								        {
								          label: "Statistik Pemilih",
								          backgroundColor: ['#e91e63', '#9c27b0', '#2196f3'],
								          data: {!! App\Helper\Lib::array2string($item['chart']['suara']) !!}
								        }
								      ]
								    },
								    options: {
								      title: {
								        display: false,
								        text: ''
								      }
								    }
								});
							</script>
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