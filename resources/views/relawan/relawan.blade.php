@extends('component.dashboard_layout')
@section('breadcrumb')
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
				<div class="widget-alpha__amount">{{$data}}</div>
				<div class="widget-alpha__description">Relawan Direkrut</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-6">
		<div class="widget widget-alpha widget-alpha--color-green-jungle">
			<div>
				<div class="widget-alpha__amount">{{$total_pemilih}}</div>
				<div class="widget-alpha__description">Jumlah Pemilih</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="statistic-widget statistic-widget-c statistic-widget-c--heliotrope">
			<div class="statistic-widget-c__heading">Pemilih</div>
			<div class="statistic-widget-c__body">
				<div class="row">
					<div class="col-md-6">
						<h2>Wanita</h2>
						<div class="statistic-widget-c__value">{{$pemilih['perempuan']}}</div>
					</div>
					<div class="col-md-6">
						<h2>Pria</h2>
						<div class="statistic-widget-c__value">{{$pemilih['laki']}}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="statistic-widget statistic-widget-c">
			<div class="statistic-widget-c__heading">Daerah Pemilih Terendah</div>
			<div class="statistic-widget-c__body">
				<canvas id="myChart" width="400" height="400"></canvas>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script>
var ctx = document.getElementById("myChart");
ctx.height = 180;
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! App\Helper\Lib::array2string($daerah['daerah']) !!},
        datasets: [{
            label: '# Pemilih',
            data: {!! App\Helper\Lib::array2string($daerah['counter']) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
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