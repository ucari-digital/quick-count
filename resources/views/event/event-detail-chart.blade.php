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
	Detail Statistik
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
				<canvas id="myChart"></canvas>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script type="text/javascript">
	var ctx = document.getElementById("myChart");
	var myChart = new Chart(ctx, {
	    type: 'horizontalBar',
	    data: {
	        labels: {!! App\Helper\Lib::array2string($data['name'], true) !!},
	        datasets: [{
	            label: '# Jumlah Pemilih',
	            data: {!! App\Helper\Lib::array2string($data['suara']) !!},
	            backgroundColor: {!! App\Helper\Lib::array2string($data['color'], true) !!},
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero:true
	                }
	            }]
	        }
	    }
	});
</script>
@endsection