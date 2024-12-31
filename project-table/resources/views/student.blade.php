<h2>All Students Data</h2>

@foreach ($students as $data)
    {{ $data->id }}<br>
    {{ $data->name }}<br>
    {{ $data->email }}<br>
    {{ $data->age }}<br>
    {{ $data->city }}<br>
    {{ $data->city_name }}<br><br>
@endforeach