@extends('component.dashboard_layout')
@section('breadcrumb')
@php
$auth = App\Helper\Lib::auth();
@endphp
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Dashboard</h2>
	</div>
</div>
@endsection
@section('content')
<div class="row">
	<div class="col-xl-3 col-lg-3 col-md-6">
		<div class="widget widget-alpha widget-alpha--color-amaranth">
			<div>
				<div class="widget-alpha__amount">{{$kabkota}} Orang</div>
				<div class="widget-alpha__description">Kordinator Kab / Kota</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-6">
		<div class="widget widget-alpha widget-alpha--color-green-jungle">
			<div>
				<div class="widget-alpha__amount">{{$kecamatan}} Orang</div>
				<div class="widget-alpha__description">Kordinator Kecamatan</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-6">
		<div class="widget widget-alpha widget-alpha--color-orange widget-alpha--donut">
			<div>
				<div class="widget-alpha__amount">{{$kelurahan}} Orang</div>
				<div class="widget-alpha__description">Kordinator Kelurahan</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-6">
		<div class="widget widget-alpha widget-alpha--color-java widget-alpha--help">
			<div>
				<div class="widget-alpha__amount">{{$relawan}}</div>
				<div class="widget-alpha__description">Relawan</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-12">
		<div class="statistic-widget statistic-widget-c">
			<div class="statistic-widget-c__heading">Daftar Pemilih</div>
			<div class="statistic-widget-c__body">
				<div class="statistic-widget-c__value">{{$pemilih}}</div>
				<div class="statistic-widget-c__title">Keseluruhan Pemilih Terdaftar</div>
				<a href="#" class="statistic-widget-c__link">Lihat lebih banyak</a>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-12">
		<div class="statistic-widget statistic-widget-c statistic-widget-c--heliotrope">
			<div class="statistic-widget-c__heading">Saksi</div>
			<div class="statistic-widget-c__body">
				<div class="statistic-widget-c__value">{{$saksi}}</div>
				<div class="statistic-widget-c__title">Keseluruhan Saksi TPS</div>
				<a href="#" class="statistic-widget-c__link">Lihat lebih detail</a>
			</div>
		</div>	
	</div>
	<div class="col-md-3 col-12">
		<div class="statistic-widget statistic-widget-c statistic-widget-c--heliotrope">
			<div class="statistic-widget-c__heading">Caleg</div>
			<div class="statistic-widget-c__body">
				<div class="statistic-widget-c__value">{{$caleg}}</div>
				<div class="statistic-widget-c__title">Total Caleg</div>
				<a href="#" class="statistic-widget-c__link">Lihat lebih detail</a>
			</div>
		</div>	
	</div>
</div>
<div class="row my-3">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="statistic-widget-c__heading">Statistik Caleg</div>
				<div class="chart" style="width: 100%; height: 300px">
					<canvas id="myChart"></canvas>
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