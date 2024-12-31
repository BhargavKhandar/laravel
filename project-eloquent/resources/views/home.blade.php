@extends('layout')

@section('title')
    All User Data
@endsection

@section('message')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@endsection

@section('content')
    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Add User</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>City</th>
                <th>Actions</th>
            </tr>
        </thead>
        @foreach ($users as $user)
            <tbody>
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->age }}</td>
                    <td>{{ $user->city }}</td>
                    <td>
                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-info">View</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                          {{-- delete form --}}
                          <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline">
                              @csrf
                              @method('DELETE')
                              {{-- model --}}
                              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      Are you want to delete this data ?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </form>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Update</a>
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>
  
@endsection