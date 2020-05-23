@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', ['title' => __('Data Vendor'), 'sub_title' => __('Operasional')])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive py-4">
                        <div class="d-flex justify-content-center justify-content-md-end mb-3">
                            @can('create_vendor')
                            <a href="{!! route('admin.vendor.create') !!}"
                                class="btn btn-rounded btn-primary mb-1 mr-2">
                                <i class="fa fa-plus"></i> Buat Vendor Baru
                            </a>
                            @endcan
                        </div>
                        <table class="table table-flush" id="myTable">
                            <thead>
                                <tr>
                                    <th>Kode Vendor</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telp</th>
                                    <th>PIC</th>
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
        ajax: '{!! route('admin.vendor.index') !!}',
        columns: [
            { data: 'kode'},
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'telp', name: 'telp' },
            { data: 'pic', name: 'pic' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', width: '10%' }
        ]
    });
        $('#create-warehouse').click(function () {
            $('#crud_ajax').modal('show');
        });
        $('body').on('click', '.delete-row', function(){
            var id = $(this).data('row-id');
            confirm("Yakin Untuk Menghapus Data Ini?");
                var url = "{{ route('admin.vendor.destroy',':id') }}";
                url = url.replace(':id', id);
                var token = "{{ csrf_token() }}";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        redirect:true,
                        data: {'_token': token, '_method': 'DELETE'},
                        success: function (response) {
                                table.draw();
                                toastr.success('Data Vendor Dihapus', 'Sukses')
                            }
                    });
                    
            });
    });

   

</script>
@endpush

@endsection