@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="float-right"> Ubah Pengguna {{$users->name}} </h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.users.update', $users->id) }}" autocomplete="off">
                        @csrf
                        @method('put')
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Nama</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-alternative" id="inputEmail3"
                            placeholder="Nama" name="name" required value="{{$users->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Email</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control form-control-alternative" id="inputEmail3"
                                    placeholder="Email" name="email" required value="{{$users->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Password</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control form-control-alternative" id="inputEmail3"
                                    name="password">
                                    <p class="text-warning">Biarkan kosong, jika tidak ingin mengganti password</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Roles</label>
                            <div class="col-sm-7">
                                <select name="roles" id="roles"
                                    class="form-control form-control-alternative select2">
                                    @foreach ($roles as $row)
                                        <option value="{{ $row->name }}">{{ $row->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                </div>
                <p>
            </form>
            </div>
        </div>
    </div>
</div>

@push('js')
@endpush

@endsection
