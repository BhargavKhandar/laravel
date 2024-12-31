<a href="/">Home page</a>
@php
    $fruits = ["one" => "Apple", "two" => "Banana", "three" => "Pine-apple", "four" => "water-melon"];

    // { 
    //  this for --------- @includeWhen, @includeUnless
    //  this is boolen variable (true, false)
    //  $boolen = true;
    //  create a condition (created by developer)
    //  variable is empty this condition is true and declare the value this is false
    //  $value = "";
    $value = "bhargav";
    // }
@endphp

{{-- this method show conditional value (true, flase) run this condition and show the page or data --}}
{{-- @includeWhen(empty($value), "pages.header", ['names' => $fruits]) --}}

{{-- this method the condition is false this will run --}}
@includeUnless(empty($value), "property.header", ['names' => $fruits])

<h1>Our welcome page</h1>

{{-- call page with href --}}
<a href="/show">Show value</a>

{{-- this method normaly  include the page is exist --}}
@include("property.footer")

{{-- this method use the page is exist to call the page or does not exist does not show the error --}}
@includeIf("pages.content")
