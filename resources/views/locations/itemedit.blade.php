@extends('layouts.app')
@section('content')
    <div>
        <h1>Edit item {{ $item }} from location {{ $location->name }} </h1>
        <form action="/locations/{{ $location->id }}/item" method="POST">
            @csrf
            @method('PUT')
            <p>Quantity on location:</p>
            <input type="text" name="qty" placeholder="Quantity" value="{{$location->qty}}">
            <button type="submit">Submit</button>
        </form>
        @if ($location->qty === 0)
        <form action="/locations/{{$location->id}}/remove"method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Remove item from location &rarr;</button>
        </form>
        @endif
    </div>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
    
    @endif
@endsection