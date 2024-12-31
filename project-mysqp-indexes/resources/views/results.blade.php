{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>

<body>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search..." required>
        <button type="submit">Search</button>
    </form>

    <h2>Users</h2>
    @foreach ($users as $user)
        <p>{{ $user->name }} - {{ $user->email }}</p>
    @endforeach

    <h2>Posts</h2>
    @foreach ($posts as $post)
        <p>{{ $post->title }} - {{ $post->content }}</p>
    @endforeach

    <h2>Comments</h2>
    @foreach ($comments as $comment)
        <p>{{ $comment->comment }}</p>
    @endforeach

    <h2>Categories</h2>
    @foreach ($categories as $category)
        <p>{{ $category->name }}</p>
    @endforeach
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>

<body>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search..." required>
        <button type="submit">Search</button>
    </form>

    <p>Search completed in <strong>{{ number_format($processingTime, 4) }}</strong> seconds.</p>

    <h2>Users</h2>
    @foreach ($users as $user)
        <p>{{ $user->name }} - {{ $user->email }}</p>
    @endforeach

    <h2>Posts</h2>
    @foreach ($posts as $post)
        <p>{{ $post->title }} - {{ $post->content }}</p>
    @endforeach

    <h2>Comments</h2>
    @foreach ($comments as $comment)
        <p>{{ $comment->comment }}</p>
    @endforeach

    <h2>Categories</h2>
    @foreach ($categories as $category)
        <p>{{ $category->name }}</p>
    @endforeach
</body>

</html>
