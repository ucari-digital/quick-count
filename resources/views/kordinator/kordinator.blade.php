@extends('component.dashboard_layout')
@section('breadcrumb')
@php
$auth = App\Helper\Lib::auth();
@endphp
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
				<button class="btn btn-primary btn-sm btn-toggle" data-toggle="collapse" href="#card-box" role="button" aria-expanded="false" aria-controls="card-box">Hide</button>
			</li>
		</ul>
	</nav>
</div>
@endsection
@section('content')
<div class="collapse" id="card-box">
	<div class="row">
		<div class="col-md-4 stretch-card grid-margin js-link" data-link="{{url('kordinator/kabkota')}}">
			<div class="card bg-gradient-danger card-img-holder text-white">
				<div class="card-body">
					<img src="{{url("storage/images/dashboard/circle.svg")}}" class="card-img-absolute" alt="circle-image">
					<h4 class="font-weight-normal mb-3">Kordinator Kab/Kota</h4>
					<h1 class="">{{$kabkota}} <span style="font-size: 16px">Org</span></h1>
				</div>
			</div>
		</div>
		<div class="col-md-4 stretch-card grid-margin js-link" data-link="{{url('kordinator/kecamatan')}}">
			<div class="card bg-gradient-info card-img-holder text-white">
				<div class="card-body">
					<img src="{{url("storage/images/dashboard/circle.svg")}}" class="card-img-absolute" alt="circle-image">
					<h4 class="font-weight-normal mb-3">Kordinator Kecamatan</h4>
					<h1 class="">{{$kecamatan}} <span style="font-size: 16px">Org</span></h1>
				</div>
			</div>
		</div>
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-success card-img-holder text-white js-link" data-link="{{url('kordinator/kelurahan')}}">
				<div class="card-body">
					<img src="{{url("storage/images/dashboard/circle.svg")}}" class="card-img-absolute" alt="circle-image">
					<h4 class="font-weight-normal mb-3">Kordinator Kelurahan</h4>
					<h1 class="">{{$kelurahan}} <span style="font-size: 16px">Org</span></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		@if($auth->posisi == 'kelurahan')
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-warning card-img-holder text-white js-link" data-link="{{url('relawan/data/saksi')}}">
				<div class="card-body">
					<img src="{{url("storage/images/dashboard/circle.svg")}}" class="card-img-absolute" alt="circle-image">
					<h4 class="font-weight-normal mb-3">Saksi</h4>
					<h1 class="">{{$saksi}} <span style="font-size: 16px">Org</span></h1>
				</div>
			</div>
		</div>
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-primary card-img-holder text-white js-link" data-link="{{url('relawan/data/')}}">
				<div class="card-body">
					<img src="{{url("storage/images/dashboard/circle.svg")}}" class="card-img-absolute" alt="circle-image">
					<h4 class="font-weight-normal mb-3">Relawan</h4>
					<h1 class="">{{$relawan}} <span style="font-size: 16px">Org</span></h1>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
<div class="page-header">
	<h3 class="page-title">
	<span class="page-title-icon bg-gradient-primary text-white mr-2">
		<i class="mdi mdi-chart-bar"></i>
	</span>
	Statistik Perolehan Suara
	</h3>
	<nav aria-label="breadcrumb">
		<ul class="breadcrumb">
			<li class="breadcrumb-item active" aria-current="page">
				<button class="btn btn-primary btn-sm btn-toggle-chart" data-toggle="collapse" href="#card-chart" role="button" aria-expanded="false" aria-controls="card-chart">Hide</button>
			</li>
		</ul>
	</nav>
</div>
<div class="collapse" id="card-chart">
	<div class="row mt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="chart" style="width: 100%; height: 300px">
						<canvas id="myChart"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div style="display: none;" class="dname"></div>
@endsection
@section('footer')
<script type="text/javascript">
$(document).ready(function() {
	$('#card-box,#card-chart').collapse('show');
	$('#card-box').on('shown.bs.collapse', function () {
		$('.btn-toggle').html('hide');
	})
	$('#card-box').on('hidden.bs.collapse', function () {
		$('.btn-toggle').html('show');
	})

	$('#card-chart').on('shown.bs.collapse', function () {
		$('.btn-toggle-chart').html('hide');
	})
	$('#card-chart').on('hidden.bs.collapse', function () {
		$('.btn-toggle-chart').html('show');
	})
});
function datareturn() {
	return getKandidat();
}
var getKandidat = function(){
	var config;
	$.ajax({
	    url: '{{url('chart-kandidat')}}', // point to server-side PHP script 
	    cache: false,
	    dataType: 'json',
	    contentType: false,
	    processData: false,
	    type: 'get',
	    async: false,
	    success: function(data){
	    	config = data;
	    },
	    error: function(e) {
	    	console.log(e);
		}
	});
	return config;
}();
console.log(getKandidat)
var ctx = document.getElementById("myChart");
ctx.height = 300;
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: getKandidat.name,
        datasets: [{
            label: '# of Votes',
            data: getKandidat.suara,
            backgroundColor: getKandidat.color,
            borderColor: getKandidat.color,
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
        },
        maintainAspectRatio: false,
    }
});
</script>
@endsection