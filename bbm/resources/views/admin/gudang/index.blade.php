@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        @if (auth()->user()->can('create_gudang'))
                        <div class="d-flex justify-content-center justify-content-md-end mb-3">
                            <a href="{!! route('admin.gudang.create') !!}" class="btn btn-rounded btn-primary mb-1 mr-2">
                                <i class="fa fa-plus"></i> Buat Gudang Baru
                            </a>
                        </div>
                        @endif
                        <table id="myTable" class="table w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Gudang</th>
                                    <th>Nama Gudang</th>
                                    <th>Jenis Gudang</th>
                                    <th>Kapasitas</th>
                                    <th>Warehouse</th>
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
        ajax: '{!! route('admin.gudang.index') !!}',
        columns: [
            { data: 'DT_RowIndex'},
            { data: 'kode_gudang', name: 'kode_gudang' },
            { data: 'nama_gudang', name: 'nama_gudang' },
            { data: 'jenis_gudang', name: 'jenis_gudang' },
            { data: 'kapasitas_gudang', name: 'kapasitas_gudang' },
            { data: 'kode_warehouse', name: 'kode_warehouse' },
            { data: 'action', name: 'action', width: '20%' }
        ]
    });
        $('#create-warehouse').click(function () {
            $('#crud_ajax').modal('show');
        });
        $('body').on('click', '.delete-row', function(){
            var id = $(this).data('row-id');
            confirm("Yakin Untuk Menghapus Data Ini?");
                var url = "{{ route('admin.warehouses.destroy',':id') }}";
                url = url.replace(':id', id);
                var token = "{{ csrf_token() }}";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        redirect:true,
                        data: {'_token': token, '_method': 'DELETE'},
                        success: function (response) {
                                table.draw();
                                
                            }
                    });
                    
            });
    });

   

</script>

@endpush

@endsection
