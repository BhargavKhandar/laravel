@extends('layouts.app')

@section('content')
    <div class="min-w-full align-middle">
        @can('create', \App\Models\Task::class)
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add new task</a>
            <br /><br />
        @endcan
        <div id="success-msg">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div id="error-msg">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <td>Task Name</td>
                    @can('update')
                        <td>Actions</td>
                    @endcan
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                @foreach ($tasks as $task)
                    <tr class="bg-white">
                        <td>{{ $task->name }}</td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            @can('update', $task)
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete', $task)
                                |
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Are you sure?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        let success_msg = $('#success-msg');
        let error_msg = $('#error-msg');
        if (success_msg.length > 0) {
            setTimeout(() => {
                success_msg.fadeOut();
            }, 5000);
        }
        if (error_msg.length > 0) {
            setTimeout(() => {
                error_msg.fadeOut();
            }, 5000);
        }
    </script>
@endsection
