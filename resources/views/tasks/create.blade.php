@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="POST" action="/tasks">
            @csrf
            <div class="form-group mx-auto w-50 p-3">
		<h1>Create new task</h1>
		<label for="t_type">Type</label>
              	<input type="text" class="form-control" id="t_type" name="type" aria-describedby="task_type" placeholder="Task type">
		<small id="item_name" class="form-text text-muted">Task types: 1-Move Stock , 2-Check Stock</small><br>
		<label for="location">Starting location</label>
		<input type="text" class="form-control" id="location"  name="location" aria-describedby="location" placeholder="Location">
		<label for="destination">Destination</label>
		<input type="text" class="form-control" id="destination" name="destination" aria-describedby="destination" placeholder="Destination (of moved stock)">
		<label for="SKU">SKU of item</label>
		<input type="text" class="form-control" id="SKU"  name="SKU" aria-describedby="SKU" placeholder="Item SKU">
		<label for="qty">Qty of item</label>
		<input type="text" class="form-control" id="qty" name="qty" aria-describedby="qty" placeholder="Quantity">

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
