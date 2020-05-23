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
                            <a href="{!! route('admin.roles.create') !!}" class="btn btn-rounded btn-primary mb-1 mr-2">
                                <i class="fa fa-plus"></i> Buat Pengguna
                            </a>
                        </div>

                        <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Role</td>
                                            <td>Guard</td>
                                            <td>Created At</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @forelse ($role as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->guard_name }}</td>
                                            <td>{{ $row->created_at }}</td>
                                            <td>
                                                <form action="{{ route('admin.roles.destroy', $row->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
​
                            <div class="float-right">
                                {!! $role->links() !!}
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

@endpush

@endsection
