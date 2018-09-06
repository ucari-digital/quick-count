@extends('component.dashboard_layout')
@php
$auth = App\Helper\Lib::auth();
@endphp
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Relawan</h2>
	</div>
	@if($auth->posisi == 'kelurahan')
	<div class="page-content__header-meta">
		<a href="{{url('relawan/create')}}" class="btn btn-info icon-left">
			Tambah
		</a>
	</div>
	@endif
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
							<th>Foto</th>
							<th>Nomor KTP</th>
							<th>Nama Lengkap</th>
							<th>No. HP</th>
							<th>Sebagai Saksi</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $item)
						<tr>
							<td></td>
							<td><img src="{{url($item->foto)}}" alt="" class="rounded"></td>
							<td>{{$item->no_ktp}}</td>
							<td>{{$item->name}}</td>
							<td>{{$item->no_hp}}</td>
							@if($item->posisi == 'saksi')
							<td>Ya</td>
							@else
							<td>Tidak</td>
							@endif
							<td>
								<div class="btn-group">
									<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Aksi
									</button>
									<div class="dropdown-menu">
										@if($auth->role == 'superadmin')
											@if($item->posisi == 'relawan_ring2')
											<a class="dropdown-item" href="{{url('/dl/pemilih/'.$item->anggota_id)}}">Lihat Anggota</a>
											@else
											<a class="dropdown-item" href="{{url('/dl/'.$item->role.'/'.$item->anggota_id)}}">Lihat Anggota</a>
											@endif
										@endif
										{{-- <a class="dropdown-item" href="{{url('kordinator/p/'.$item->anggota_id)}}">Lihat Profil</a> --}}
										<a class="dropdown-item" href="{{url('relawan/edit/'.$item->anggota_id)}}">Edit</a>

										@if($item->posisi == 'saksi')
										<a class="dropdown-item" href="{{url('saksi/delete/'.$item->anggota_id)}}">Tidak Jadikan Saksi</a>
										@else
										<a class="dropdown-item" href="#" onclick="modl('{{$item->anggota_id}}', '{{$item->name}}')">Jadikan Saksi</a>
										@endif
										
										@if($item->downline == 0)
										<a class="dropdown-item" href="{{url('hapus/u/'.$item->anggota_id)}}">Hapus</a>
										@endif
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

{{-- MODAL SAKSI --}}
<div class="modal fade" id="saksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Saksi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{url('saksi/create')}}" method="post" class="form">
					@csrf
					<input type="hidden" name="anggota_id">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="name" class="form-control" readonly="">
					</div>
					<div class="form-group">
						<label>Kabupaten / Kota</label>
						<select name="kabkota" class="form-control kabkota">
							<option>PILIH</option>
							@foreach($kota as $item)
							<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Kecamatan</label>
						<select name="kecamatan" class="form-control kecamatan">
							
						</select>
					</div>
					<div class="form-group">
						<label>Kelurahan</label>
						<select name="kelurahan" class="form-control kelurahan">
							
						</select>
					</div>
					<div class="form-group">
						<label>TPS</label>
						<input type="text" name="tps" class="form-control" placeholder="TPS" />
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary submit">Save changes</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script type="text/javascript">
	$('.submit').click(function(){
		$('.form').submit();
	});
	function modl(anggota_id, name) {
		$('input[name="name"]').val(name);
		$('input[name="anggota_id"]').val(anggota_id);
		$('#saksi').modal({
  			keyboard: false,
  			show: true
		})
	}
	$('.kabkota').change(function(){
		$('.kecamatan').html('');
		$('.kecamatan').append($("<option></option>").attr("value", "").text('PILIH'));
		$.get('{{url('kecamatan')}}/'+$(this).val(), function(data){
			$.each(data, function(key, value) {  
				$('.kecamatan')
				.append($("<option></option>")
			        .attr("value",value.id)
			        .text(value.name)); 
			});
		});
	});
	$('.kecamatan').change(function(){
		$('.kelurahan').html('');
		$('.kelurahan').append($("<option></option>").attr("value", "").text('PILIH'));
		$.get('{{url('kelurahan')}}/'+$(this).val(), function(data){
			$.each(data, function(key, value) {  
				$('.kelurahan')
				.append($("<option></option>")
			        .attr("value",value.id)
			        .text(value.name)); 
			});
		});
	});
</script>
@endsection