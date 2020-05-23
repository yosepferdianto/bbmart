@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">

                        </div>
                        <div class="col-6">
                            <h3 class="float-right"> Buat Barang Baru </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.barang.store') }}" autocomplete="off">
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
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Kode Barang</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-alternative" id="inputEmail3"
                                    placeholder="Kode Barang" name="kode_barang" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Nama Barang</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-alternative" id="inputEmail3"
                                    placeholder="Nama Barang" name="nama_barang" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Kategori</label>
                            <div class="col-sm-7">
                                <select name="kode_kategori" id="kode_kategori"
                                    class="form-control form-control-alternative select2">
                                    @foreach($kategori as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Satuan</label>
                            <div class="col-sm-7">
                                <select name="kode_satuan" id="kode_satuan"
                                    class="form-control form-control-alternative select2">
                                    @foreach($satuan as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama_satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if (auth()->user()->can('value_barang'))
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="input-name">Harga Beli</label>
                                    <input type="number" name="harga_beli" id="harga_beli"
                                        class="form-control form-control-alternative"
                                        placeholder="0" value="0"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Komisi</label>
                                    <input type="number" name="komisi" id="komisi" class="form-control form-control-alternative"
                                        placeholder="0" step="1" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="input-phone">Harga Jual Minimal</label>
                                    <input type="number" name="harga_jual" id="harga_jual"
                                        class="form-control form-control-alternative" placeholder="0" value="0"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        @endif
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
<script>
    $(document).ready(function() {
    $("#komisi").on("keydown keyup", function() {
        calculateTotal();
        });
    });
        function calculateTotal() {
            var komisi = parseFloat($('#komisi').val());
            var harga_beli = parseFloat($('#harga_beli').val());
            var totalkomisi = 0;
            var harga_jual = 0;

            harga_jual = parseFloat(harga_beli + komisi).toFixed(0);
            $("#harga_jual").val(harga_jual);
        }
</script>
@endpush
@endsection