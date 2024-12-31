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
            <div class="col-4">
                <h3 class="text-center p-3">Update New Employee</h3>
                <form action="{{ route('update.employee', $emp->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">name</label>
                        <input type="text" value="{{ $emp->name }}" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" value="{{ $emp->email }}" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">city</label>
                        <input type="text" value="{{ $emp->city }}" class="form-control" name="city">
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">age</label>
                        <input type="age" value="{{ $emp->age }}" class="form-control" name="age">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>