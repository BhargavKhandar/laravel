@extends('layouts.app')

@section('content')
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>Create New User</h1>
        <a href="{{ route('user') }}"><button type="button" class="btn btn-primary">Users List</button></a>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body m-3">
                        <form method="POST" action="{{ route('panel.user.save') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                                        required>
                                    <div class="text-danger">
                                        {{ $errors->first('email') }}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputRole" class="col-sm-2 col-form-label">Select Role</label>
                                <div class="col-sm-12">
                                    <select name="role_id" id="" class="form-control">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option {{ old('role_id') == $role->id ? 'selected' : '' }}
                                                value="{{ $role->id }}">
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 float-end">
                                <div class="col-sm-12">
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
