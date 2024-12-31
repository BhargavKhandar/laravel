@extends('layouts.app')

@section('content')
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>Users</h1>
        <a href="{{ route('panel.user.create') }}"><button type="button" class="btn btn-primary">Create New
                User</button></a>
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
                                    <th class="col-3">Name</th>
                                    <th class="col-3">Email</th>
                                    <th class="col-2">Role</th>
                                    <th class="col-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr class="row">
                                        <td class="col-1">{{ $key + 1 }}</td>
                                        <td class="col-3">{{ $user->name }}</td>
                                        <td class="col-3">{{ $user->email }}</td>
                                        <td class="col-2">
                                            {{ $user->role_name }}
                                            {{-- @foreach ($roles as $role)
                                                @if ($role->id == $user->role_id)
                                                    {{ $role->name }}
                                                @endif
                                            @endforeach
                                            @if (!$user->role_id)
                                                -
                                            @endif --}}
                                        </td>
                                        <td class="col-3 d-flex align-items-center">
                                            <a href="{{ route('panel.user.edit', $user->id) }}"
                                                class="btn btn-primary me-2"><i class="bi-pen me-2"></i>Edit</a>
                                            <form action="{{ route('panel.user.delete', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="bi-trash"></i>
                                                    Delete</button>
                                            </form>
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
