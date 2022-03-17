@extends('layouts.app')
@section('content')
 <div class="container">
        <form method="POST" action="/locations/{{ $location->id }}">
	@csrf
	@method('PUT')
            <div class="form-group mx-auto w-50">
		<h1>Update location</h1>
		<input type="text" class="form-control" name="name" placeholder="Location name" value="{{$location->name}}">
		<select name="format" class="form-control custom-select custom-select-md">
			@foreach($formats as $format)
			<option value="{{ $format['format'] }}" @if ($current_format==$format['format']) selected="selected" @endif > {{ $format['format'] }} ( {{ $format['capacity'] }} )</option>
                	@endforeach
		</select>
              <button type="submit" class="btn btn-primary btn-block my-2">Submit</button>
            </div>
	  </form>
	<form class="form-group mx-auto w-50" action="/locations/{{ $location->id }}/unset" method="POST">
            @csrf
            @method('PUT')
            <input type ="hidden" name="format_id" value="null" />
            <button type="submit" class="btn btn-outline-danger">Unset format</button>
        </form>

    </div>
	@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
    
    @endif
@endsection
