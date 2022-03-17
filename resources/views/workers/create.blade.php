@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="POST" action="/workers">
            @csrf
            <div class="form-group mx-auto w-50">
                <h1>Create new worker</h1>
		<label for="name">Worker name</label>
		<input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Name">
		<label for="surname">Worker Surname</label>
		<input type="text" class="form-control" id="surname"  name="surname" aria-describedby="location" placeholder="Location">
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
