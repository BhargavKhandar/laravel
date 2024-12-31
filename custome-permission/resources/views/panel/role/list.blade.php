@extends('layouts.app')

@section('content')
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>Roles</h1>
        @if (!empty($PermissionAddRole))
            <a href="{{ route('panel.role.create') }}">
                <button type="button" class="btn btn-primary">
                    Create New Role
                </button>
            </a>
        @endif
    </div>
    @include('layouts._message')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr class="row">
                                    <th class="col-1">#</th>
                                    <th class="col-5">Name</th>
                                    <th class="col-3">Date</th>
                                    @if (!empty($PermissionEditRole) || !empty($PermissionDeleteRole))
                                        <th class="col-3">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr class="row">
                                        <td class="col-1">{{ $key + 1 }}</td>
                                        <td class="col-5">{{ $role->name }}</td>
                                        <td class="col-3">{{ $role->created_at->format('d-m-Y') }}</td>
                                        <td class="col-3 d-flex align-items-center">
                                            @if (!empty($PermissionEditRole))
                                                <a href="{{ route('panel.role.edit', $role->id) }}"
                                                    class="btn btn-primary me-2">
                                                    <i class="bi-pen me-2"></i>
                                                    Edit
                                                </a>
                                            @endif
                                            @if (!empty($PermissionDeleteRole))
                                                <form action="{{ route('panel.role.delete', $role->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"><i class="bi-trash"></i>
                                                        Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
