@extends('component.dashboard_layout')
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Penambahan Daftar Pemilih</h2>
	</div>
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
				<form action="{{url('pemilih/submit')}}" method="post" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="referred_by" value="{{App\Helper\Lib::auth()->anggota_id}}">
					<input type="hidden" name="anggota_id" class="form-control" placeholder="User ID">
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label>No KTP</label>
								<input type="text" name="no_ktp" class="form-control" placeholder="No KTP" />
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label>Nama (Sesuai KTP)</label>
								<input type="text" name="name" class="form-control" placeholder="Nama Lengkap" onchange="GUID(this.value)"/>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select name="jk" id="" class="form-control">
									<option value="L">L</option>
									<option value="P">P</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label>Tempat, Tgl lahir</label>
								<div class="input-group">
									<input type="text" name="tempat" class="form-control" placeholder="Tempat lahir">
									<input type="text" name="tgl_lahir" class="form-control" id="date-mask" placeholder="Tgl lahir">
								</div>
							</div>
						</div>
						<div class="col-md-7">
							<div class="form-group">
								<label>Alamat rumah sekarang</label>
								<input type="text" name="alamat" class="form-control" placeholder="Alamat rumah" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Kabupaten / Kota</label>
								<select name="kabkota" class="form-control kabkota" required="">
									<option value="">PILIH</option>
									@foreach($kota as $item)
									<option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Kecamatan</label>
								<select name="kecamatan" class="form-control kecamatan" required="">
									<option value="">PILIH</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Kelurahan</label>
								<select name="kelurahan" class="form-control kelurahan" required="">
									<option value="">PILIH</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>RT/RW</label>
								<input type="text" name="rtrw" class="form-control" placeholder="RT/RW">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>No HP</label>
								<input type="text" name="no_hp" class="form-control" placeholder="No HP">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Foto</label>
								<input type="file" name="foto" class="form-control" placeholder="Foto">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Foto KTP</label>
								<input type="file" name="foto_ktp" class="form-control" placeholder="Foto">
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-gradient-primary">Simpan</button>
							<button class="btn btn-gradient-secondary">Batal</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script type="text/javascript">
	function GUID(value) {
		var array = value.split(' ');
		$("input[name=anggota_id]").val(array[0]+getRandomInt(99));
	}
	function getRandomInt(max) {
		return Math.floor(Math.random() * Math.floor(max));
	}
	$('.kabkota').change(function(){
		$('.kecamatan').html('');
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