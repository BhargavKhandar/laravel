@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-between">
                        <p>Create Task</p>
                        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Home</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <!-- Task Name -->
                            <div class="form-group mb-3">
                                <label for="name">Task Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter task name" required>
                            </div>

                            <!-- Due Date -->
                            <div class="form-group mb-3">
                                <label for="due_date">Due Date</label>
                                <input type="date" name="due_date" id="due_date" class="form-control" required>
                            </div>

                            <!-- User ID -->
                            <div class="form-group mb-3">
                                <label for="user_id">User</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Create Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
