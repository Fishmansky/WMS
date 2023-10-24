@extends('layouts.app')
@section('content')
<div class="container">
        <form method="POST" action="/locations/{{ $location->id }}/put">
	@csrf
	@method('PUT')
            <div class="form-group mx-auto w-50">
		<h1>Put item on {{ $location->name }}</h1>
		<input type="text" class="form-control" name="SKU" placeholder="Item">
		<input type="text" class="form-control" name="qty" placeholder="Quantity">
              <button type="submit" class="btn btn-primary btn-block my-2">Submit</button>
            </div>
	  </form>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
        
    @endif
@endsection
