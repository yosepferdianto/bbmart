@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="float-right"> Ubah Gudang {{ $gudang->nama_gudang }} </h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.gudang.update', $gudang->id) }}" autocomplete="off">
                        @csrf
                        @method('put')
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <input type="hidden" name="id" value="{{ $gudang->id }}">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Kode Gudang</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-alternative" id="inputEmail3" placeholder="Kode Gudang" name="kode_gudang"
                                    required value="{{ $gudang->kode_gudang }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Nama Gudang</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-alternative" value="{{ $gudang->nama_gudang }}" id="inputEmail3" placeholder="Nama Gudang" name="nama_gudang"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Lokasi Gudang</label>
                            <div class="col-sm-7">
                                <select name="kode_warehouse" id="kode_warehouse" class="form-control form-control-alternative select2">
                                    @foreach($warehouse as $b)
                                    <option @if($gudang->kode_warehouse == $b->kode_warehouse) selected @endif
                                        value="{{ $b->kode_warehouse }}" >
                                        {{ $b->nama_warehouse }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Jenis Gudang</label>
                            <div class="col-sm-7">
                                <select name="jenis_gudang" id="jenis_gudang" class="form-control form-control-alternative select2">
                                    <option @if($gudang->jenis_gudang == "1") selected @endif value="1">Tangki</option>
                                    <option @if($gudang->jenis_gudang == "2") selected @endif value="2">Non Tangki</option>
                                </select>
                            </div>  
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Kapasitas Gudang</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control form-control-alternative" id="inputEmail3" placeholder="Kapasitas Gudang"
                                    name="kapasitas_gudang" value="{{ $gudang->kapasitas_gudang }}">
                            </div>  
                        </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@push('js')
@endpush

@endsection
