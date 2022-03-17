@extends('layouts.app')
@section('content')

<div class="container">
    <nav class="navbar navbar-light bg-light justify-content-between">
      <a class="navbar-brand">Dispatch</a>
        <a href="dispatch/create" role="button" class="btn btn-outline-primary">Create new shipment +</a>
        <form class="form-inline" method="get" action="/dispatch">
        @csrf
        @method('GET')
        @if(isset($_GET['search']))
        <input required class="form-control mr-sm-2" type="search" name ="search" placeholder="Search by SKU" aria-label="Search" value="{{ $_GET['search'] }}">
        @else
        <input required class="form-control mr-sm-2" type="search" name ="search" placeholder="Search by SKU" aria-label="Search">
        @endif 
        <button class="btn btn-outline-primary col-5" type="submit">Search</button>
        <a href="dispatch" role="button" class="btn btn-outline-secondary col-6">Reset</a>
        </form>
    </nav>
  
      <div class="row justify-content-center">
          <div class="col-md-12">
              <table class="table table-hover">
                  <thead>
                      <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Waybill</th>
                      <th scope="col">Carrier</th>
                      <th scope="col">Cargo Number</th>
                      <th scope="col">Ordered</th>
                      <th scope="col">Collection</th>
                      <th scope="col">Item list</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($shipments as $row)
                      <tr>
                          <td>
                            {{ $row['id'] }}
                          </td>
                          <td>
                            {{ $row['waybill'] }}
                          </td>
                          <td>
                            {{ $row['carrier'] }}
                          </td>
                          <td>
                            {{ $row['cargo_number'] }}
                          </td>
                          <td>
                            {{ $row['order_date'] }}
                          </td>
                          <td>
                            {{ $row['collection_date'] }}
                          </td>
                          <td>
                            {{ $row['itemlist'] }}
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
              </table>
          </div>
      </div>
  </div>
  

@endsection
