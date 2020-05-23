@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="d-flex justify-content-center justify-content-md-end mb-3">
                            <a href="{!! route('admin.satuan.create') !!}" class="btn btn-rounded btn-primary mb-1 mr-2">
                                <i class="fa fa-plus"></i> Buat Satuan Baru
                            </a>
                        </div>

                        <table id="myTable" class="table w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Satuan</th>
                                    <th>Nama Satuan</th>
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
        ajax: '{!! route('admin.satuan.index') !!}',
        columns: [
            { data: 'DT_RowIndex'},
            { data: 'kode_satuan', name: 'kode_satuan' },
            { data: 'nama_satuan', name: 'nama_satuan' },
            { data: 'action', name: 'action', width: '20%' }
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
