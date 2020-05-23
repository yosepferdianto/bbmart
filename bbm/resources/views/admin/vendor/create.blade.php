@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="float-right"> Buat Vendor </h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.vendor.store') }}" autocomplete="off">
                        @csrf
                        @method('post')
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Kode Vendor</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-alternative" id="inputEmail3" placeholder="Kode Vendor" name="kode_vendor"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Nama Vendor</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-alternative" id="inputEmail3" placeholder="Nama Vendor" name="nama_vendor"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Email Vendor</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control form-control-alternative" id="inputEmail3" placeholder="vendor@email.com" name="email_vendor">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Nomer Telp Vendor</label>
                            <div class="col-sm-7">
                                <input type="tel" class="form-control form-control-alternative" id="inputEmail3" placeholder="Telp Vendor" name="telp_vendor">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Alamat Vendor</label>
                            <div class="col-sm-7">
                                <textarea class="form-control form-control-alternative" id="inputEmail3" placeholder="Alamat Vendor" name="alamat_vendor"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">PIC Vendor</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-alternative" id="inputEmail3" placeholder="Nama PIC" name="pic_vendor">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">NPWP Vendor</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-alternative" id="inputEmail3" placeholder="Nomer NPWP Vendor" name="npwp_vendor">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Nomer Virtual Account</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-alternative" id="inputEmail3" placeholder="Nomer NPWP Vendor" name="npwp_vendor">
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
