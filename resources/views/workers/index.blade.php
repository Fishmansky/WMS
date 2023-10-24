@extends('layouts.app')
@section('content')

<div class="container">
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand">Tasks</a>
        <a href="workers/create" role="button" class="btn btn-outline-primary">Add new worker +</a>
        <form class="form-inline" method="get" action="/workers">
        @csrf
        @method('GET')
        @if(isset($_GET['search']))
        <input required class="form-control mr-sm-2" type="search" name ="search" placeholder="Search by login" aria-label="Search" value="{{ $_GET['search'] }}">
        @else
        <input required class="form-control mr-sm-2" type="search" name ="search" placeholder="Search by login" aria-label="Search">
        @endif 
        <button class="btn btn-outline-primary col-5" type="submit">Search</button>
        <a href="workers" role="button" class="btn btn-outline-secondary col-6">Reset</a>
        </form>
      </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Login</th>
                    <th scope="col">Activity status</th>
                    <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($workers as $row)
                    <tr>
                        <td>
                        {{ $row['login'] }}
                        </td>
                        <td>
			@if($row['is_available']=='1')
			FREE
			@else
			ASSIGNED TO TASK: {{ $tasks[$row->id] }}
			@endif
                        </td>
			<td>
                        <a href="#" class="btn btn-outline-primary btn-md">Info</a>
			</td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
