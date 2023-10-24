@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="POST" action="/items">
            @csrf
            <div class="form-group mx-auto w-50 p-3">
                <h1>Create new item</h1>
              	<input type="text" class="form-control" id="item_name" name="description" aria-describedby="item_name" placeholder="Item name">
	      	<small id="item_name" class="form-text text-muted">Type in the name for new item</small>
		<input type="text" class="form-control" id="SKU"  name="SKU" aria-describedby="location_name" placeholder="SKU number">
		<input type="text" class="form-control" id="qty" name="qty" aria-describedby="location_name" placeholder="Quantity">

              <br>
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
