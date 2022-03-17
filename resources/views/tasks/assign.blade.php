@extends('layouts.app')
@section('content')
 <div class="container">
        <form method="POST" action="/tasks/{{ $task->id }}/assign">
	@csrf
	@method('PUT')
            <div class="form-group mx-auto w-50">
		<h1>Assign task {{ $task->id }}</h1>
		<select name="worker_login" class="form-control custom-select custom-select-md">
			@foreach($workers as $worker)
			<option value="{{ $worker['login'] }}" > {{ $worker['login'] }}</option>
                	@endforeach
		</select>
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
