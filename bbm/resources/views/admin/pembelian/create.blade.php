@extends('layouts.app', ['title' => __('User Profile')])


@section('content')
@include('users.partials.header', ['title' => __('Buat Permintaan Pembelian Barang'), 'sub_title' => __('Pembelian')])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 col-md-12">
            <form method="post" action="{{ route('admin.satuan.store') }}" autocomplete="off">
                <div class="row">
                    <div class="col-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <h3 class="float-right"> Masukan Kode Barang </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Kode Barang</label>
                                    <div class="col-sm-7">
                                        <select id="kode_barang" class="form-control" data-toggle="select"></select>
                                    </div>
                                </div>
                                <input type="hidden" id="id_barang" name="id_barang">
                                <input type="hidden" id="kdbrng" name="kdbrng">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Nama Barang</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-alternative"
                                            id="nama_barang" placeholder="Nama Barang" name="nama_barang" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Satuan</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-alternative"
                                            id="kode_satuan" placeholder="Kode Satuan" name="kode_satuan" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Qty</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control form-control-alternative" id="qty"
                                            placeholder="Qty" name="qty">
                                    </div>
                                </div>
                                @can('value_pembeliana')
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Harga Satuan</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control form-control-alternative"
                                            id="harga_beli" placeholder="Harga Satuan" name="harga_beli">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Sub Total</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control form-control-alternative"
                                            id="sub_total" placeholder="Sub Total" name="sub_total">
                                    </div>
                                </div>
                                @endcan
                                <div class="float-right">
                                    <button type="button" class="btn btn-primary mt-4" id="add-item">Tambahkan
                                        Barang</button>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-header">
                                <h3> Summary</h3>
                            </div>
                            <div class="card-body">

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!--new row-->
                    <div class="col-8">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Nomer</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-alternative"
                                            id="inputEmail3" placeholder="Kode Satuan" name="kode_satuan"
                                            value="{{$nomer}}" required readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Pilih Vendor</label>
                                    <div class="col-sm-7">
                                        <select id="user_id" class="form-control" data-toggle="select"></select>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div id="department_ajax">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Pilih Warehouse</label>
                                    <div class="col-sm-7">
                                        <select id="kode_warehouse" class="form-control" data-toggle="select"></select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush" id="table-pembelian">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Satuan</th>
                                                <th>Harga Satuan</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')

<script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
    $('#user_id').select2({
            ajax: {
                url: "{{ route('admin.settings.search-pic') }}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                    results:  $.map(data, function (item) {
                        return {
                        text: item.name,
                        id: item.id,
                        email: $('#email').val(item.email)   
                        }
                    })
                    };
                },
                cache: true
                }
            });

            jQuery("#user_id").change(function() {
                let userId = $('#user_id').val();
                let url = '{{route('admin.vendor.show', ":id")}}';
                url = url.replace(":id", userId);

                jQuery.get(url, function(data, status) {
                jQuery('#department_ajax').html(data);
        });
    });
</script>
<script>
    $('#kode_warehouse').select2({
            ajax: {
                url: "{{ route('admin.warehouses.search-warehouse') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                        return {
                        text: item.nama_warehouse,
                        id: item.id, 
                        kode : item.kode_warehouse
                        }
                    })
            };
        },
        cache: true
    },
    }).on("change", function(e) {
        console.log($(this).select2('data'));
    });

    $('#kode_barang').select2({
            ajax: {
                url: "{{ route('admin.barang.search-barang') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                        return {
                        text: item.nama_barang+' ('+item.kode_barang+')',
                        id: item.id,
                        id_barang : $('#id_barang').val(item.id),
                        nama_barang: $('#nama_barang').val(item.nama_barang),
                        satuan: $('#kode_satuan').val(item.nama_satuan),
                        harga_beli: $('#harga_beli').val(item.harga_beli),
                        kdbrng: $('#kdbrng').val(item.kode_barang)     
                        }
                    })
            };
        },
        cache: true
    },
    templateSelection: function (selection) {
                        var result = selection.text.split('-');
                        return result[0];
                    }
    }).on("change", function(e) {
        console.log($(this).select2('data'));
    }); 
</script>
<script>
    $(document).ready(function() {
    $("#qty").on("keydown keyup", function() {
        calculateTotal();
        });
    });
        function calculateTotal() {
            var komisi = parseFloat($('#qty').val());
            var harga_beli = parseFloat($('#harga_beli').val());
            var harga_jual = 0;

            harga_jual = parseFloat(harga_beli * komisi).toFixed(0);
            $("#sub_total").val(harga_jual);
            
        }
        
    $('#add-item').click(function () {
        let id_barang = $('#id_barang').val();
        let kode_barang = $('#kdbrng').val();
        let nama_barang = $('#nama_barang').val();
        let satuan = $('#kode_satuan').val();
        let qty = $('#qty').val();
        let harga_beli = $('#harga_beli').val();
        let subtotal = $('#sub_total').val();
        let item = '<tr>\n' +
            '                    <td><input type="hidden" name="kode_barang[]" value="'+kode_barang+'">\n' +
            '                        '+kode_barang+'</td>\n' +
            '                    <td>'+nama_barang+'</td>\n' +
            '                    <td>'+satuan+'</td>\n' +
            '                    <td>'+harga_beli+'</td>\n' +
            '                    <td>'+qty+'</td>\n' +
            '                    <td class="text-right cart-subtotal-'+id_barang+'">'+subtotal+'</td>\n' +
            '                    <td>\n' +
            '                        <a href="javascript:;" class="btn btn-danger btn-sm btn-circle delete-cart-row"><i class="fa fa-times" aria-hidden="true"></i></a>\n' +
            '                    </td>\n' +
            '                </tr>';
        $('#table-pembelian tbody').append(item);
    });
    $('#table-pembelian').on('click', '.delete-cart-row', function () {
        $(this).closest('tr').remove();
        calculateTotal();
    });
</script>
@endpush

@endsection