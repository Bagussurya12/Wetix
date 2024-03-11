@extends('layouts.dashboard')

@section('content')
<div class="mb-2">
    <a href="{{ route('dashboard.theaters.arrange.movie.create', $theater -> id) }}" class="btn btn-success btn-sm"> + Movie</a>
</div>
@if(session() -> has('message'))
    <div id="alertSuccess" class="alert alert-success d-flex justify-content-between align-items-center">
        <strong>{{session() -> get('message')}}</strong>
        <button id="closeAlert" type="button" class="close" style="border: none; background: none; font-weight: bold;">
        <span>&times;</span>
        </button>
    </div>
@endif

<div class="card mt-4">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h3 class="font-weight-bold align-self-center mt-3">
                    Arrange Movie - {{$theater -> theater}}
                </h3>
            </div>
            <div class="col-4">
                <form method="get" action="{{url('dashboard/theaters')}}">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" name="q" value="{{$request['q'] ?? ' ' }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm m-2" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-borderless table-striped tabel-hover">
            <thead>
                <tr>
                    <th>Movie</th>
                    <th>Studio</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arrangeMovies as $arrangeMovie)
                    <tr>
                        <th>{{$arrangeMovie -> movies -> first() -> title}} </th>
                        <th>{{$arrangeMovie -> studio}}</th>
                        <th>{{$arrangeMovie -> price}}</th>
                        <th>{{$arrangeMovie -> status}}</th>
                        <th>&nbsp;</th>
                    </tr>
                @endforeach
            </tbody>
        </table>     
    </div>
</div>

@endsection

<script>
    document.getElementById("closeAlert").addEventListener("click", function() {
        document.getElementById("alertSuccess").style.display = "none";
    });
</script>