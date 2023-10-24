@extends('layouts.app')
@section('content')

<div class="container">
  <nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">Locations</a>
    <a href="locations/create" role="button" class="btn btn-outline-primary">Add new location +</a>
    <form class="form-inline" method="get" action="/locations">
      @csrf
      @method('GET')
      @if(isset($_GET['search']) && isset($_GET['by']))
      <select name="by" class="form-control custom-select custom-select-md">
        <option value="1" @if($_GET['by']=="1") selected="selected" @endif >Name</option>
        <option value="2" @if($_GET['by']=="2") selected="selected" @endif >Format</option>
        <option value="3" @if($_GET['by']=="3") selected="selected" @endif >SKU</option>
      </select>
      <input required class="form-control mr-sm-2" type="search" name ="search" placeholder="Search.." aria-label="Search" value="{{ $_GET['search'] }}">
      @else
      <select name="by" class="form-control custom-select custom-select-md">
        <option value="1" selected>Name</option>
        <option value="2">Format</option>
        <option value="3">SKU</option>
      </select>
      <input required class="form-control mr-sm-2" type="search" name ="search" placeholder="Search..." aria-label="Search">
      @endif
      <button class="btn btn-outline-primary my-sm-2 col-5" type="submit">Search</button>
      <a href="locations" role="button" class="btn btn-outline-secondary my-sm-2 col-6">Reset</a>
    </form>
  </nav>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Format</th>
                    <th scope="col">Item/SKU</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $row)
                    <tr>
                        <td>
                        {{ $row['name'] }}
                        </td>
                        <td>
                        @if (!is_null($row->format_id))
                        {{ $formats[$row->id] }}
                        @else
			            <a href="locations/{{ $row->id }}/edit">Set format</a>
			            @endif
                        </td>
                        <td>
                        @if(is_null($row->format_id))
                        -
                        @else
                        @if (!is_null($row->item_id))
                        {{ $items[$row->id] }} <br> {{ $SKUs[$row->id] }}
                        @else
                        <a href="locations/{{ $row->id }}/put">Put item</a>
                        @endif
                        @endif
                        </td>
                        <td>
                        @if (!is_null($row->qty))
                        {{ $row['qty'] }} / {{ $formatqts[$row->id] }} ({{ round(($row['qty']/$formatqts[$row->id])*100,2) }}%)
                        @else
                        -
                        @endif
                        </td>
                        <td>
                        @if(is_null($row->format_id))
                        <form action="/locations/{{ $row->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                        @else
                        @if(is_null($row->item_id))
                        <a href="locations/{{ $row->id }}/edit" role ="button" class="btn btn-outline-primary">Edit</a>
                        @else
                        <a href="tasks/create" role ="button" class="btn btn-outline-primary">Replenishment</a>
                        @endif
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

