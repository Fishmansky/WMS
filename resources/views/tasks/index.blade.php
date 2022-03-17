@extends('layouts.app')
@section('content')

<div class="container">
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand">Tasks</a>
        <a href="tasks/create" role="button" class="btn btn-outline-primary">Add new task +</a>
        <form class="form-inline" method="get" action="/tasks">
        @csrf
        @method('GET')
        @if(isset($_GET['search']))
        <input required class="form-control mr-sm-2" type="search" name ="search" placeholder="Search by ID" aria-label="Search" value="{{ $_GET['search'] }}">
        @else
        <input required class="form-control mr-sm-2" type="search" name ="search" placeholder="Search by ID" aria-label="Search">
        @endif 
        <button class="btn btn-outline-primary col-5" type="submit">Search</button>
        <a href="tasks" role="button" class="btn btn-outline-secondary col-6">Reset</a>
        </form>
      </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Type</th>
                    <th scope="col">Location</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Item/SKU</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Status</th>
                    <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $row)
                    <tr>
                        <td>
                        {{ $row['type'] }}
                        </td>
                        <td>
                        {{ $locations[$row->id] }}
                        </td>
                        <td>
                        {{ $destinations[$row->id] }}
                        </td>
                        <td>
                        {{ $items[$row->id] }}
                        </td>
                        <td>
                        {{ $row['qty'] }}
                        </td>
                        <td>
                        {{ $row['created_at'] }}
                        </td>
                        <td @if($row['status'] == '1') class="text-secondary" @else class="text-warning"@endif >
			{{ $statuses[$row->id] }}
			@if($row['status']=='2')
			<br> by {{ $workers[$row->id] }}
			@endif
                        </td>
			<td>
			@if($row['status']=='1')
                        <a href="/tasks/{{$row->id}}" class="btn btn-outline-primary btn-md">Assign</a>
			@else
			@endif
			</td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
