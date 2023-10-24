@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="POST" action="/formats">
            @csrf
            <div class="form-group mx-auto w-50 p-3">
                <h1>Create new format</h1>
              <input type="text" class="form-control" id="format" name="format" aria-describedby="format" placeholder="Format name">
              <small id="format" class="form-text text-muted">Type in the name of new format</small>
              <input type="text" class="form-control" name="capacity" placeholder="Storage capacity">
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