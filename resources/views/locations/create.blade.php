@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="POST" action="/locations">
            @csrf
            <div class="form-group mx-auto w-50 p-3">
                <h1>Create new location</h1>
              <input type="text" class="form-control" id="location_name" name="name" aria-describedby="location_name" placeholder="Name of location">
              <small id="location_name" class="form-text text-muted">Type in the name for new location </small>
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
