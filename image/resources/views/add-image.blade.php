<form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" accept="image/*">
    <button type="submit">Upload Image</button>
</form>
