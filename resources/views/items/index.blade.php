@extends('layouts.app')
@section('content')

<div class="container">
    <nav class="navbar navbar-light bg-light justify-content-between">
      <a class="navbar-brand">Items</a>
        <a href="items/create" role="button" class="btn btn-outline-primary">Add new item +</a>
        <form class="form-inline" method="get" action="/items">
        @csrf
        @method('GET')
        @if(isset($_GET['search']))
        <input required class="form-control mr-sm-2" type="search" name ="search" placeholder="Search by SKU" aria-label="Search" value="{{ $_GET['search'] }}">
        @else
        <input required class="form-control mr-sm-2" type="search" name ="search" placeholder="Search by SKU" aria-label="Search">
        @endif 
        <button class="btn btn-outline-primary col-5" type="submit">Search</button>
        <a href="items" role="button" class="btn btn-outline-secondary col-6">Reset</a>
        </form>
    </nav>
  
      <div class="row justify-content-center">
          <div class="col-md-12">
              <table class="table table-hover">
                  <thead>
                      <tr>
                      <th scope="col">Item Name</th>
                      <th scope="col">SKU</th>
                      <th scope="col">Current Q-ty</th>
                      <th scope="col">Options</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($items as $row)
                      <tr>
                          <td>
                            {{ $row['description'] }}
                          </td>
                          <td>
                            {{ $row['SKU'] }}
                          </td>
                          <td>
                            {{ $row['qty'] }}
                          </td>
                          <td>
                            <form method="get" action="/locations">
                              @csrf
                              @method('GET')
                              <input type="hidden" name ="by" value="3">
                              <input type="hidden" name ="search" value="{{ $row['SKU'] }}">
                              <button type="submit" class="btn btn-outline-primary btn-sm">Show locations</button>
                            </form>
                            <a href="#" role="button" class="btn btn-outline-primary btn-sm">Order more stock</a>
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
              </table>
          </div>
      </div>
  </div>
  

@endsection
