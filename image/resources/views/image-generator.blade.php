<!DOCTYPE html>
<html>
<head>
    <title>Generate Image</title>
</head>
<body>
    <form action="{{ route('generate') }}" method="POST">
        @csrf
        <label for="prompt">Enter a prompt:</label>
        <input type="text" name="prompt" required>
        <select name="size">
            <option value="sm">Small</option>
            <option value="md">Medium</option>
            <option value="lg">Large</option>
        </select>
        <button type="submit">Generate Image</button>
    </form>    
</body>
</html>
