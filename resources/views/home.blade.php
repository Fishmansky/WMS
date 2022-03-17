@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 p-2">
            <div class="card">
                <h2 class="card-header text-center">Locations</h2>

                <div class="card-body">
                    Create new or edit existing locations!
                </div>
                <a href="/locations" role="button" class="btn btn-primary mr-10">Go</a>
            </div>
        </div>
        <div class="col-md-6 p-2">
            <div class="card">
                <h2 class="card-header text-center">Storage formats</h2>

                <div class="card-body">
                    Create new or edit existing storage formats!
                </div>
                <a href="/formats" role="button" class="btn btn-primary mr-10">Go</a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 p-2">
            <div class="card">
                <h2 class="card-header text-center">Items</h2>

                <div class="card-body">
                    Manage items in your warehouse!
                </div>
                <a href="/items" role="button" class="btn btn-primary mr-10">Go</a>
            </div>
        </div>
    <div class="col-md-6 p-2">
        <div class="card">
            <h2 class="card-header text-center">Tasks</h2>

            <div class="card-body">
                Manage tasks in your warehouse!
            </div>
            <a href="/tasks" role="button" class="btn btn-primary mr-10">Go</a>
        </div>
    </div>
    <div class="col-md-6 p-2">
        <div class="card">
            <h2 class="card-header text-center">Workers</h2>

            <div class="card-body">
                Manage your team!
            </div>
            <a href="/workers" role="button" class="btn btn-primary mr-10">Go</a>
        </div>
    </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 p-2">
            <div class="card">
                <h2 class="card-header text-center">Dispatch</h2>

                <div class="card-body">
                    Manage your dispatch here!
                </div>
                <a href="/dispatch" role="button" class="btn btn-primary mr-10">Go</a>
            </div>
        </div>
        <div class="col-md-6 p-2">
            <div class="card">
                <h2 class="card-header text-center">Goods In</h2>
    
                <div class="card-body">
                    Manage goods comming in!
                </div>
                <a href="/goodsin" role="button" class="btn btn-primary mr-10">Go</a>
            </div>
        </div>
    </div>

	

</div>
@endsection
