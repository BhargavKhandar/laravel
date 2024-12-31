<h1>This is header page</h1>

{{-- @foreach ($names as $key => $fruit)
    <p>{{ $key }} :- {{ $fruit }}</p>
@endforeach --}}

{{-- using this method data is empty to show the error massage --}}
@forelse ( $names as $key => $fruit )
    <p>{{ $key }} :- {{ $fruit }}</p>    
@empty
    <p>No value found.</p>
@endforelse