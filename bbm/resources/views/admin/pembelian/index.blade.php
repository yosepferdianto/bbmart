@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', ['title' => __('Permintaan Pembelian'), 'sub_title' => __('Pembelian')])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="d-flex justify-content-center justify-content-md-end mb-3">
                            <a href="{!! route('admin.pembelian.create') !!}" class="btn btn-rounded btn-primary mb-1 mr-2">
                                <i class="fa fa-plus"></i> Permintaan Pembelian
                            </a>
                        </div>

                        <table id="myTable" class="table table-flush">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No PO</th>
                                    <th>Vendor</th>
                                    <th>Warehouse</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.pembelian.index') !!}',
        columns: [
            { data: 'DT_RowIndex'},
            { data: 'no_po', name: 'kode_satuan' },
            { data: 'vendor_id', name: 'nama_satuan' },
            { data: 'warehouse_id', name: 'nama_satuan' },
            { data: 'tgl_minta', name: 'tgl_minta' },
            { data: 'status', name: 'tgl_minta' },
            { data: 'action', name: 'action'}
        ]
    });
        $('#create-warehouse').click(function () {
            $('#crud_ajax').modal('show');
        });
        $('body').on('click', '.delete-row', function(){
            var id = $(this).data('row-id');
            confirm("Yakin Untuk Menghapus Data Ini?");
                var url = "{{ route('admin.satuan.destroy',':id') }}";
                url = url.replace(':id', id);
                var token = "{{ csrf_token() }}";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        redirect:true,
                        data: {'_token': token, '_method': 'DELETE'},
                        success: function (response) {
                                table.draw();
                                toastr.success('Data Berhasil Dihapus', 'Sukses')
                            }
                    });
                    
            });
    });

   

</script>

@endpush

@endsection
