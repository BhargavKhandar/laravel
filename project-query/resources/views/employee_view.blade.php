<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="d-flex justify-content-between mt-2 mb-2">
                    <h3 class="text-center">All Employee</h3>
                    <a href="/add_employee" class="btn btn-success">Add Employee</a>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>age</th>
                        <th>City</th>
                        <th>View</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </thead>
                    <tbody>

                        @foreach ($data as $id => $employee)

                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->age }}</td>
                                <td>{{ $employee->city }}</td>
                                <td>
                                    <a href="{{ route('view.employee', $employee->id) }}" class="btn btn-info">View</a>
                                </td>
                                <td>
                                    <a href="{{ route('delete.employee', $employee->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                                <td>
                                    <a href="{{ route('update.page', $employee->id) }}" class="btn btn-warning">Update</a>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
                <div class="mt-5">
                    {{-- usin bootstrap in laravel --}}
                    {{-- {{ $data->links('pagination::bootstrap-5') }} --}}
                    {{ $data->links() }}
                </div>
                <div>
                    {{-- Total Employee :- {{ $data->total() }}<br>
                    Current Page :- {{ $data->currentPage() }} --}}
                </div>
            </div>
        </div>
    </div>
</body>
</html>