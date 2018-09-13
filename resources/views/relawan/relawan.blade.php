@extends('component.dashboard_layout')
@section('title')
Relawan
@endsection
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Relawan</h2>
	</div>
</div>
@endsection
@section('content')
<div class="row justify-content-md-center">
	<div class="col-md-3">
		<div class="widget widget-alpha widget-alpha--color-amaranth">
			<div>
				<div class="widget-alpha__amount">{{$total_relawan_l}}</div>
				<div class="widget-alpha__description">Relawan Laki-Laki</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-md-3">
		<div class="widget widget-alpha widget-alpha--color-green-jungle">
			<div>
				<div class="widget-alpha__amount">{{$total_relawan_p}}</div>
				<div class="widget-alpha__description">Relawan Perempuan</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-md-3">
		<div class="widget widget-alpha widget-alpha--color-orange">
			<div>
				<div class="widget-alpha__amount">{{$total_relawan}} / 2000</div>
				<div class="widget-alpha__description">Target Relawan</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-md-3">
		<div class="widget widget-alpha widget-alpha--color-java">
			<div>
				<div class="widget-alpha__amount">{{$total_relawan}}</div>
				<div class="widget-alpha__description">Jumlah Relawan</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="statistic-widget statistic-widget-c" style="height: 400px">
			<div class="statistic-widget-c__heading">Statistik Relawan</div>
			<div class="statistic-widget-c__body">
				<canvas id="myChart" width="400" height="400"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="widget widget-controls widget-contacts widget-controls--dark" style="height: 400px">
			<div class="widget-controls__header">
				<div>
					<span class="widget-controls__header-icon ua-icon-user-solid"></span> 10 Relawan Terbaru
				</div>
			</div>
			<div class="widget-controls__content js-scrollable" data-simplebar="init"><div class="simplebar-track vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="top: 2px; height: 213px;"></div></div><div class="simplebar-track horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar"></div></div><div class="simplebar-scroll-content" style="padding-right: 17px; margin-bottom: -34px;"><div class="simplebar-content" style="padding-bottom: 17px; margin-right: -17px;">
			<div class="widget-controls__content-wrap">
				<div class="widget-contacts__item">
					<img src="img/users/user-4.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Gabriel Saunders</a>
						<div class="widget-contacts__item-email">gabriel@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-5.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Shawna Cohen</a>
						<div class="widget-contacts__item-email">shawna@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-6.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Jason Kendall</a>
						<div class="widget-contacts__item-email">jason@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-7.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Thomas Banks</a>
						<div class="widget-contacts__item-email">thomas@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-8.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Rebecca Harris</a>
						<div class="widget-contacts__item-email">rebecca@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-6.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Jason Kendall</a>
						<div class="widget-contacts__item-email">jason@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-7.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Thomas Banks</a>
						<div class="widget-contacts__item-email">thomas@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-8.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Rebecca Harris</a>
						<div class="widget-contacts__item-email">rebecca@example.com</div>
					</div>
				</div>
			</div>
		</div></div></div>
		<div class="widget-controls__footer">
			<a href="#" class="widget-controls__footer-view-all">
				<span class="widget-controls__footer-view-all-icon iconfont-arrow-circle-right"></span><span>Lihat Semua</span>
			</a>
		</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
	<script type="text/javascript">
		$('#collapse3').collapse('hide');
	</script>
	<script>
	var ctx = document.getElementById("myChart");
	ctx.height = 300;
	var myChart = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels:  {!! App\Helper\Lib::array2string($days['time'], true) !!},
	        datasets: [{
	            label: '# of Votes',
	            data: {!! App\Helper\Lib::array2string($days['value']) !!},
	            backgroundColor: 'rgba(255, 99, 132, 0.2)',
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