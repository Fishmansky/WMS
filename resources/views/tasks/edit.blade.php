@extends('layout.app')
@section('content')
    <div>
        <h1>Update item</h1>
        <form action="/items/{{ $item->id }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="description" placeholder="Item description" value="{{$item->description}}">
            <input type="text" name="SKU" placeholder="SKU" value="{{$item->SKU}}">
            <input type="text" name="qty" placeholder="Quantity" value="{{$item->qty}}">
            <button type="submit">Submit</button>
        </form>
    </div>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
    
    @endif
@endsection