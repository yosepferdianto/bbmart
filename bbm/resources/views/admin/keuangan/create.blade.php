<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Buat Data Bank Baru</h5>
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
            <label for="inputEmail3" class="col-sm-5 col-form-label">Nama Bank</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Bank" name="nama_bank"
                    required>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Cabang</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Cabang" name="cabang_bank"
                    required>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Nama Rekening</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Rekening" name="nama_rekening"
                    required>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-5 col-form-label">Nomer Rekening</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Nomer Rekening"
                    name="no_rekening">
            </div>  
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" id="save-form" class="btn btn-success btn-light-round"><i
        class="fa fa-check"></i> Simpan </button>
</form>
</div>
<script>
    $('#save-form').click(function () {
        const form = $('#keuanganForm');

        $.easyAjax({
            url: '{{route('admin.keuangans.store')}}',
            container: '#keuanganForm',
            type: "POST",
            redirect: true,
            data: form.serialize(),
            
        })
    });
</script>