@extends('layouts.app')
@section('content')
 <div class="container">
        <form method="POST" action="/formats/{{ $format->id }}">
	@csrf
	@method('PUT')
            <div class="form-group mx-auto w-50">
		<h1>Update format</h1>
		<label for="format_name">Format name</label>
		<input type="text" class="form-control" name="format" id="format_name" placeholder="Storage format" value="{{$format->format}}">
		<label for="storage_capacity">Format capacity</label>
		<input type="text" class="form-control" name="capacity" id="storage_capacity" placeholder="Format capacity" value="{{$format->capacity}}">
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
