@extends('layouts.app')
@section('title', 'Biodata')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            	<div class="card-header">
            		List Biodata
            	</div>
            	<div class="card-body">
                    <form action="{{ route('biodata.search') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-7 form-group">
                                <input type="text" class="form-control" name="cari" placeholder="Cari...">
                            </div>
                            <div class="col-md-1 form-group">
                                <button class="btn btn-success" type="submit">Cari</button>
                            </div>
                            <div class="col-md-1">
                                <a href="{{ route('biodata.create') }}" class="btn btn-primary mb-3">Tambah</a>
                            </div>
                        </div>
                    </form>
            		@if (session('status'))
	            		<?php echo session('status') ?>
            		@endif
            		<table class="table table-stripped table-hover">
            			<thead class="thead-dark">
	            			<tr>
	            				<th>#</th>
	            				<th>Nama</th>
	            				<th>Alamat</th>
	            				<th>Pekerjaan</th>
	            				<th>Opsi</th>
	            			</tr>
            			</thead>
            			<tbody>
            				@php
            					$number = ($biodata->currentPage() - 1) * $biodata->perPage() + 1
            				@endphp
                            @if($biodata->count() > 0)
            				@foreach($biodata as $bio)
		            			<tr>
		            				<td>{{ $number++ }}</td>
		            				<td>{{ $bio->nama }}</td>
		            				<td>{{ $bio->alamat }}</td>
		            				<td>{{ $bio->pekerjaan }}</td>
		            				<td>
		            					<a href="{{ route('biodata.edit', $bio->id) }}" class="btn btn-info">Ubah</a>
		            					<form action="{{ route('biodata.destroy', $bio->id) }}" method="POST" style="display: inline-block;">
	            							@csrf
	            							@method('DELETE')
			            					<button class="btn btn-danger" type="submit">Hapus</button>
			            				</form>
		            				</td>
		            			</tr>
	            			@endforeach
                            @else
                                <tr>
                                    <td colspan="5" style="text-align: center;">Tidak ada data</td>
                                </tr>
                            @endif
            			</tbody>
            		</table>
                    {{ $biodata->links() }}
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection