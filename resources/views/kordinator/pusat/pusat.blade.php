@extends('component.dashboard_layout')
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Kordinator Pusat</h2>
	</div>
	<div class="page-content__header-meta">
		<a href="{{url('kordinator/pusat/create')}}" class="btn btn-info icon-left">
			Tambah
		</a>
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
							{{-- <th>Pengikut</th> --}}
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
							{{-- <td>{{$item->downline}} Pengikut</td> --}}
							<td>
								<div class="btn-group">
									<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Aksi
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="{{url('kordinator/dl/'.$item->anggota_id)}}">Lihat Anggota</a>
										{{-- <a class="dropdown-item" href="{{url('kordinator/p/'.$item->anggota_id)}}">Lihat Profil</a> --}}
										<a class="dropdown-item" href="{{url('kordinator/'.$item->posisi.'/edit/'.$item->anggota_id)}}">Edit</a>
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
@endsection