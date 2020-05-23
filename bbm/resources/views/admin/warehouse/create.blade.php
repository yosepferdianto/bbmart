<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Buat Data Warehouse Baru</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form role="form" id="keuanganForm" class="ajax-form" method="POST">
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
    <button type="button" id="save-form" class="btn btn-success btn-light-round"><i class="fa fa-check"></i> Simpan
    </button>
    </form>
</div>
<script>
    $('#save-form').click(function () {
        const form = $('#keuanganForm');

        $.ajax({
            url: '{{route('admin.warehouses.store')}}',
            container: '#keuanganForm',
            type: "POST",
            dataType: 'json',
            redirect: true,
            data: form.serialize()
            
        });
    });

    
</script>