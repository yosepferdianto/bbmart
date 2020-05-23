@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="float-right"> Pengaturan Hak Akses </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card card-stats mb-4 mb-xl-0">
                                            <div class="card-header text-uppercase text-muted text-small mb-0">
                                                <h5 class="float-left"> Tambah Hak Akses</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <form action="{{ route('admin.users.add_permission') }}" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="">Nama Hak Akses</label>
                                                            <input type="text" name="name" autofocus
                                                                class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}"
                                                                required>
                                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-primary btn-sm">
                                                                Add New
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>          ​
                                    <div class="col-xl-8 col-lg-8">
                                        <div class="card">
                                            <div class="card-header text-uppercase text-muted text-small mb-0">
                                                <h5 class="float-right"> Set Hak Akses Ke Role </h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('admin.users.roles_permission') }}" method="GET">
                                                    <div class="form-group row">
                                                        <label for="">Roles</label>
                                                        <div class="input-group">
                                                            <select name="role" class="form-control form-alternative">
                                                                @foreach ($roles as $value)
                                                                <option value="{{ $value }}"
                                                                    {{ request()->get('role') == $value ? 'selected':'' }}>
                                                                    {{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-danger">Check!</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </form>

                                                {{-- jika $permission tidak bernilai kosong --}}
                                                @if (!empty($permissions))
                                                <form
                                                    action="{{ route('admin.users.setRolePermission', request()->get('role')) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <div class="form-group">
                                                        <div class="nav-tabs-custom">
                                                            <ul class="nav nav-tabs">
                                                                <li class="active">
                                                                    <a href="#tab_1" data-toggle="tab">Permissions</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div class="tab-pane active" id="tab_1">
                                                                    @php $no = 1; @endphp
                                                                    @foreach ($permissions as $key => $row)
                                                                    <input type="checkbox" name="permission[]"
                                                                        class="minimal-red" value="{{ $row }}"
                                                                        {{--  CHECK, JIKA PERMISSION TERSEBUT SUDAH DI SET, MAKA CHECKED --}}
                                                                        {{ in_array($row, $hasPermission) ? 'checked':'' }}>
                                                                    {{ $row }} <br>
                                                                    @if ($no++%5 == 0)
                                                                    <br>
                                                                    @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="float-right">
                                                        <button class="btn btn-primary btn-sm">
                                                            <i class="fa fa-send"></i> Set Permission
                                                        </button>
                                                    </div>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')


@endpush

@endsection