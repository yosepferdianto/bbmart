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
                            <a href="javascript:;" id="create-warehouse" class="btn btn-rounded btn-primary mb-1 mr-2">
                                <i class="fa fa-plus"></i> @lang('app.createNew')
                            </a>
                        </div>

                        <table id="myTable" class="table w-100">
                            <thead>
                                <tr>
                                    <th>Kode Warehouse</th>
                                    <th>Nama Warehouse</th>
                                    <th>Kode Cabang</th>
                                    <th>Jumlah Gudang</th>
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

<div class="modal fade" id="crud_ajax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Cabang Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.warehouses.store') }}" autocomplete="off"
                enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Kode Warehouse</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Kode Warehouse"
                                name="kode_warehouse" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Nama Warehouse</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Warehouse"
                                name="nama_warehouse" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Cabang</label>
                        <div class="col-sm-7">
                            <select name="kode_cabang" id="kode_cabang" class="form-control form-control-lg">
                                @foreach($branchs as $b)
                                <option value="{{ $b->kode_cabang }}">{{ $b->nama_cabang }}</option>
                                @endforeach
                            </select>
            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Alamat Warehouse</label>
                        <div class="col-sm-7">
                            <textarea class="form-control form-control-lg" name="alamat_warehouse" id="alamat_warehouse" cols="30"
                                rows="4" placeholder="Alamat Warehouse"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Longitude</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Longitude Warehouse"
                                name="longitude_warehoue">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Latitude</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Latitude Warehouse"
                                name="latitude_warehouse">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes

                </button>
            </div>
            </form>
        </div>
    </div>
</div>
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.warehouses.index') !!}',
        columns: [
           
            { data: 'kode_warehouse', name: 'kode_warehouse' },
            { data: 'nama_warehouse', name: 'nama_warehouse' },
            { data: 'kode_cabang', name: 'kode_cabang' },
            { data: 'count', name: 'count' },
            { data: 'action', name: 'action', width: '20%' }
        ]
    });
        $('#create-warehouse').click(function () {
            $('#crud_ajax').modal('show');
        });
        $('body').on('click', '.deleteProduct', function () {
            var id = $(this).data('id');
            confirm("Yakin Untuk Menghapus Data Ini?");
                var url = "{{ route('admin.warehouses.destroy',':id') }}";
                url = url.replace(':id', id);
                var token = "{{ csrf_token() }}";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {'_token': token, '_method': 'DELETE'},
                        success: function (result) {
                            if (result.status == "success") {
                                $('#myTable').DataTable().ajax.reload();
                                console.log(result.message);
                                    } else {
                                        console.log(result.error);
                                    }
                                
                            }
                    });
                    
            });
    });

   

</script>

@endpush

@endsection
