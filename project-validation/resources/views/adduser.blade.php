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
                <h3 class="text-center p-3">Add New User</h3>
                <form action="{{ route('adduser') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">User Name</label>
                        <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name">
                        <span class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">User Email address</label>
                        <input type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror mb-2" name="email">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">User Password</label>
                        <input type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" name="password">
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">User Age</label>
                        <input type="number" value="{{ old('age') }}" class="form-control @error('age') is-invalid @enderror" name="age">
                        <span class="text-danger">
                            @error('age')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="city">User City</label>
                        <select name="city" class="form-control @error('city') is-invalid @enderror">
                            <option value="rajkot">Rajkot</option>
                            <option value="jamnagar">Jamnagar</option>
                            <option value="baroda">Baroda</option>
                            <option value="div">Div</option>
                        </select>
                        <span class="text-danger">
                            @error('city')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">User Phone No.</label>
                        <input type="number" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" name="phone">
                        <span class="text-danger">
                            @error('phone')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>