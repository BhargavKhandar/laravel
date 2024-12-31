<a href="/">Home page</a><br>
<a href="/include">Include page</a><br><br>

{{-- how data show in blade file --}}

{{-- this method show numaric and mathematics --}}
{{ 5 + 2 }}<br><br>

{{-- this method show the string value --}}
{{ "Hello" }}<br><br>

{{-- this mehtod normaly print with <h1>. Output show with <h1> --}}
{{ "<h1>Hello</h1>" }}

{{-- this method use the all of html tages --}}
{!! "<h1>Hello World</h1>" !!}

{{-- this metho use all of javascript code --}}
{{-- {!! "<script>alert('Wel-come')</script>" !!} --}}

{{-- this method use php to show value with variable --}}
@php

    // normaly show the variable
    // $user = "Bhargav";

    // this show numeric or mathematics
    // $a = 1;
    // $b = 2;
    // $c = $a + $b;

    // print array
    $names = ["Bhargav", "Harshit", "Dinesh", "Chirag", "Meet"];

@endphp

{{-- {!! "<h1> {$user}</h1>" !!} --}}
{{-- {!! "<h1> {$c}</h1>" !!} --}}

{{-- single value show in array --}}
{{-- {{ $names[1] }} --}}

{{-- show value of full of array using foreach --}}
<ul>
    @foreach ($names as $name)
        {{-- using if, elseif, else --}}        
        @if ($loop->even)
            <li style="color: red;">{{ $name }}</li>
        @elseif ($loop->odd)
            <li style="color: blue;">{{ $name }}</li>
        @else
            <li>{{ $name }}</li>
        @endif
    @endforeach
</ul>

{{-- foreach loop property --}}
{{-- 1. $loop->index is show the index start from (0) --}}
{{-- 2. $loop->iteration is show current loop iteration start (1) --}}
{{-- 3. $loop->remaining the iterations remaining the loop \ !!! \  ' last list show bydefault style ' --}}
{{-- 4. $loop->count is count the array data  --}}
{{-- 5. $loop->first is first element to change style --}}
{{-- 6. $loop->last is last element to change style --}}
{{-- 7. $loop->even is even number  --}}
{{-- 8. $loop->odd is show the index start from (0) --}}
{{-- 9. $loop->depth nesting level of the loop --}}
{{-- 10. $loop->parent nested loop, parent's loop variable --}}