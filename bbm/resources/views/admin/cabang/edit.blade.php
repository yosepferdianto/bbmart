<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Ubah Cabang {{ $branchs->kode_cabang }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" autocomplete="off" id="ubah-cabang" value="PUT">
        @csrf
        @method('PUT')
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <input type="hidden" name="id" value="{{ $branchs->id }}">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Kode Cabang</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Kode Cabang" name="kode_cabang"
                    required value="{{ $branchs->kode_cabang }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Nama Cabang</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Cabang" name="nama_cabang"
                    required value="{{ $branchs->nama_cabang }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Alamat Cabang</label>
            <div class="col-sm-7">
                <textarea class="form-control" name="alamat_cabang" placeholder="Alamat">{{ $branchs->alamat_cabang }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Longitude</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Longitude"
                    name="longitude_cabang" {{ $branchs->longitude_cabang }}>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Latitude</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Latitude" value="{{ $branchs->latitude_cabang }}" name="latitude_cabang">
            </div>
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="Submit" id="save-form" class="btn btn-primary">Save changes</button>
</div>
</form>

<script>
    $('#save-form').click(function () {
        const form = $('#ubah-cabang');
        $.ajax({
            url: '{{route('admin.cabangs.update', $branchs->id)}}',
            container: '#ubah-cabang',
            type: 'POST',
            dataTye: 'json',
            data: $('#ubah-cabang').serialize(),
            success: function (response) {
                if(response.status == 'success'){
                    $('#application-modal').modal('hide');
                } 
            } 
        })
    });
</script>