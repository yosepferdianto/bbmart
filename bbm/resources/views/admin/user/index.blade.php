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
                            <a href="{!! route('admin.users.create') !!}" class="btn btn-rounded btn-primary mb-1 mr-2">
                                <i class="fa fa-plus"></i> Buat Pengguna
                            </a>
                        </div>

                        <table id="myTable" class="table w-100">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->getRoleNames() as $role)
                                        <label for="" class="badge badge-info">{{ $role }}</label>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($user->status)
                                        <label class="badge badge-success">Aktif</label>
                                        @else
                                        <label for="" class="badge badge-default">Suspend</label>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.users.edit',$user->id) }}"><i
                                                class="fa fa-pencil-alt"></i></a>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')


@endpush

@endsection