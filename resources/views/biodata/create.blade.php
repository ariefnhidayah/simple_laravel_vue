@extends('layouts.app')
@section('title', 'Tambah Biodata')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            	<div class="card-header">
            		Tambah Biodata
            	</div>
            	<div class="card-body">
            		<form action="{{ route('biodata.store') }}" class="form-horizontal" method="POST">
            			@csrf
            			<div class="form-group row">
            				<label for="nama" class="col-md-3">Nama</label>
            				<div class="col-md-4">
            					<input type="text" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }} " name="nama" value="{{ old('nama') }}">
            					@if ($errors->has('nama'))
            						<span class="invalid-feedback" role="alert">
            							<strong>{{ $errors->first('nama') }}</strong>
            						</span>
            					@endif
            				</div>
            			</div>
            			<div class="form-group row">
            				<label for="alamat" class="col-md-3">Alamat</label>
            				<div class="col-md-4">
            					<input type="text" class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }} " name="alamat" value="{{ old('alamat') }}">
            					@if ($errors->has('alamat'))
            						<span class="invalid-feedback" role="alert">
            							<strong>{{ $errors->first('alamat') }}</strong>
            						</span>
            					@endif
            				</div>
            			</div>
            			<div class="form-group row">
            				<label for="pekerjaan" class="col-md-3">Pekerjaan</label>
            				<div class="col-md-4">
            					<input type="text" class="form-control {{ $errors->has('pekerjaan') ? 'is-invalid' : '' }} " name="pekerjaan" value="{{ old('pekerjaan') }}">
            					@if ($errors->has('pekerjaan'))
            						<span class="invalid-feedback" role="alert">
            							<strong>{{ $errors->first('pekerjaan') }}</strong>
            						</span>
            					@endif
            				</div>
            			</div>
            			<div class="form-group row">
            				<div class="col-md-5">
            					<button class="btn btn-primary" type="submit">{{ __('Tambah') }}</button>
            					<a href="{{ route('biodata.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>
            				</div>
            			</div>
            		</form>
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection