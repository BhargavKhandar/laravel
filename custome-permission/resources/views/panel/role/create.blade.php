@extends('layouts.app')

@section('content')
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>Create New Role</h1>
        <a href="{{ route('role') }}"><button type="button" class="btn btn-primary">Roles List</button></a>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body m-3">
                        <form method="POST" action="{{ route('panel.role.save') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="inputName" class="col-sm-12 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Permission</label>
                                @foreach ($permissions as $permission)
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            {{ $permission['name'] }}
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                @foreach ($permission['groups'] as $group)
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name="permission_id[]"
                                                            value="{{ $group['id'] }}" class="me-1">{{ $group['name'] }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>

                            <div class="row mb-3 float-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
