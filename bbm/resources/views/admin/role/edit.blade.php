@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="float-right"> Ubah Satuan {{$satuan->nama_satuan}} </h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.satuan.update', $satuan->id) }}" autocomplete="off">
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
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Kode Satuan</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-alternative" id="inputEmail3" placeholder="Kode Satuan" name="kode_satuan"
                            required value="{{$satuan->kode_satuan}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Nama Satuan</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-alternative" id="inputEmail3" placeholder="Nama Satuan" name="nama_satuan"
                                    required value={{$satuan->nama_satuan}}>
                            </div>
                        </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                </div>
                <p>
            </form>
            </div>
        </div>
    </div>
</div>

@push('js')
@endpush

@endsection
