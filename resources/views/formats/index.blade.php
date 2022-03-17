@extends('layouts.app')
@section('content')

<div class="container">
  <nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">Formats</a>
    <a href="formats/create" role="button" class="btn btn-outline-primary">Add new format +</a>
    <form class="form-inline" method="get" action="/formats">
      @csrf
      @method('GET')
      @if(isset($_GET['search']))
      <input required class="form-control mr-sm-2" type="search" name ="search" placeholder="Search by name" aria-label="Search" value="{{ $_GET['search'] }}">
      @else
      <input required class="form-control mr-sm-2" type="search" name ="search" placeholder="Search by name" aria-label="Search">
      @endif
      <button class="btn btn-outline-primary my-sm-2 col-5" type="submit">Search</button>
      <a href="formats" role="button" class="btn btn-outline-secondary my-sm-2 col-6">Reset</a>
    </form>
  </nav>

      <div class="row justify-content-center">
          <div class="col-md-12">
              <table class="table table-hover">
                  <thead>
                      <tr>
                      <th scope="col">Format</th>
                      <th scope="col">Capacity</th>
                      <th scope="col">Options</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($formats as $row)
                      <tr>
                          <td>
                            {{ $row['format'] }}
                          </td>
                          <td>
                            {{ $row['capacity'] }}
                          </td>
                          <td>
                            <a href="formats/{{ $row['id']}}/edit" role="button" class="btn btn-outline-primary btn-sm">Edit format</a>
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
              </table>
          </div>
      </div>
  </div>

@endsection
