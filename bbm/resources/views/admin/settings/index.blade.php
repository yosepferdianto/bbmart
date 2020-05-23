@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 col-md-10">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row tabs-icons-text" id="tabs-icons-text"
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" data-toggle="tab" href="#data-perusahaan" role="tab"
                            aria-controls="tabs-icons-text-1" aria-selected="true"><i
                                class="fas fa-copy mr-2"></i>Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" href="#data-cabang" role="tab"><i
                                class="fas fa-building mr-2"></i>Cabang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" href="#data-keuangan" role="tab"><i
                                class="fas fa-money-bill-alt mr-2"></i>Keuangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab"
                            href="#data-pajak" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i
                                class="fas fa-money-check mr-2"></i>Pajak</a>
                    </li>
                </ul>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="data-perusahaan" role="tabpanel"
                            aria-labelledby="tabs-icons-text-1-tab">
                            <form method="post" action="{{route('admin.settings.update', $settings->id)}}"
                                autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <h6 class="heading-small text-muted mb-4">{{ __('Data Perusahaan') }}</h6>
                                @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                for="input-name">{{ __('Nama Perusahaan') }}</label>
                                            <input type="text" name="company_name" id="input-name"
                                                class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Nama Perusahaan') }}"
                                                value="{{ $settings->company_name }}" required autofocus>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('company_email') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                for="input-email">{{ __('Email') }}</label>
                                            <input type="email" name="company_email" id="input-email"
                                                class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Email') }}" value="{{ $settings->company_email }}"
                                                required>
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('company_email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="input-phone">{{ __('Telp. Perusahaan') }}</label>
                                            <input type="phone" name="company_phone" id="input-phone"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('No. Telp') }}"
                                                value="{{ $settings->company_phone }}" required>

                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Logo</label>
                                            <div class="card">
                                                <div class="card-body">
                                                    <input type="file" id="input-file-now" name="company_logo"
                                                        accept=".png,.jpg,.jpeg" class="dropify"
                                                        data-default-file="{{ $settings->logo_url }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Alamat</label>
                                            <textarea class="form-control form-control-lg" name="company_address" id=""
                                                cols="30" rows="5">{!! $settings->company_address !!}</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="date_format" class="control-label">
                                                        Kota
                                                    </label>
                                                    <input type="text" name="company_city" id="input-phone"
                                                        class="form-control form-control-alternative"
                                                        placeholder="{{ __('Kota') }}"
                                                        value="{{ $settings->company_city }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="time_format" class="control-label">
                                                        Nama PIC
                                                    </label>
                                                    <select id="user_id" name="user_id" class="form-control">
                                                        @foreach($user as $u)
                                                        <option @if($settings->user_id == $u->id) selected @endif
                                                            value="{{ $u->id }}" >
                                                            {{ $u->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="data-cabang" role="tabpanel"
                            aria-labelledby="tabs-icons-text-2-tab">
                            @include('admin.cabang.index')
                        </div>
                        <div class="tab-pane fade" id="data-keuangan" role="tabpanel"
                            aria-labelledby="tabs-icons-text-3-tab">
                            @include('admin.keuangan.index')
                        </div>
                        <div class="tab-pane fade" id="data-pajak" role="tabpanel"
                            aria-labelledby="tabs-icons-text-3-tab">
                            <p class="description">Raw denim you probably haven't heard of them jean shorts Austin.
                                Nesciunt
                                tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg
                                carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<script src="{{ asset('assets/dropify/js/dropify.js' )}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify();
        $('#tabs-icons-text a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
                $("html, body").scrollTop(0);
            });

            // store the currently selected tab in the hash value
            $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
                var id = $(e.target).attr("href").substr(1);
                window.location.hash = id;
            });

            // on load of the page: switch to the currently selected tab
            var hash = window.location.hash;
            $('#tabs-icons-text a[href="' + hash + '"]').tab('show');

            $('#redirect-general').click(function () {

            })
        
        //table cabang
        table = $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.cabangs.index') !!}',
        columns: [
            { data: 'DT_RowIndex'},
            { data: 'kode_cabang', name: 'Kode Cabang' },
            { data: 'nama_cabang', name: 'Nama Cabang' },
            { data: 'action', name: 'action', width: '20%' }
        ]
    });
        //create new cabang
        $('body').on('click', '#create-page', function () {
                var url = '{{ route('admin.cabangs.create') }}';
            });
            // edit cabang
            $('body').on('click', '.edit-cabang', function () {
                var id = $(this).data('row-id');
                var url = '{{ route('admin.cabangs.edit', ':id')}}';
                url = url.replace(':id', id);

                $('#application-modal').modal('show').find('.modal-body').load(url);
            });
            //delete cabang
            $('body').on('click', '.delete-row', function(){
                var id = $(this).data('row-id');
                swal({
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    title: "@lang('errors.areYouSure')",
                    text: "@lang('errors.deleteWarning')",
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var url = "{{ route('admin.cabangs.destroy',':id') }}";
                            url = url.replace(':id', id);

                            var token = "{{ csrf_token() }}";

                            $.easyAjax({
                                type: 'POST',
                                url: url,
                                data: {'_token': token, '_method': 'DELETE'},
                                success: function (response) {
                                    if (response.status == "success") {
                                        $.unblockUI();
                                        swal("Deleted!", response.message, "success");
                                        table._fnDraw();
                                    }
                                }
                            });
                        }
                    });
            });

        bankTable = $('#bankTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.keuangans.index') !!}',
        columns: [
            { data: 'DT_RowIndex'},
            { data: 'nama_bank', name: 'Nama Bank' },
            { data: 'nama_rekening', name: 'Nama Rekening' },
            { data: 'no_rekening', name: 'Nama Rekening' },
            { data: 'action', name: 'action', width: '20%' }
        ]
    });
    $('body').on('click', '#create-keuangan', function () {
                var url = '{{ route('admin.keuangans.create') }}';
                $('#application-modal').modal('show').find('.modal-body').load(url);
            });

    });

    

</script>
@endpush