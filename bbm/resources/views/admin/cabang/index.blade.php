<div class="table-responsive">
    <div class="d-flex justify-content-center justify-content-md-end mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#buat-cabang">
            <i class="fa fa-plus"></i> Buat Cabang baru</a></button>
    </div>

    <table id="myTable" class="table w-100">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Cabang</th>
                <th>Nama Cabang</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>

</div>

<div class="modal fade" id="buat-cabang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Cabang Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.cabangs.store') }}" autocomplete="off"
                    enctype="multipart/form-data">
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
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Kode Cabang</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Kode Cabang"
                                name="kode_cabang" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Nama Cabang</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Cabang"
                                name="nama_cabang" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Alamat Cabang</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="alamat_cabang" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Longitude</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Longitude"
                                name="longitude_cabang">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Latitude</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Latitude"
                                name="latitude_cabang">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">  
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--edit-->
