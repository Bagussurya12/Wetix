@extends('layouts.dashboard')

@section('content')

<div class="card mt-4">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h3 class="font-weight-bold align-self-center">Movies</h3>
            </div>
            <div class="col-4">
                <form method="get" action="{{url('dashboard/movies')}}">
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
            <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Action</th>
                </tr>
            </thead>   
    
            <tbody>
                @foreach ($movies as $movie)
                <tr>
                    <th scope="row">{{($movies -> currentPage()-1) * $movies -> perPage() + $loop -> iteration}}</th>
                    <td>{{$movie -> title}}</td>
                    <td>{{$movie -> thumbnail}}</td>

                    <td>
                        <!-- <a href="{{ url('dashboard/movie/edit/'.$movie->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fa-solid fa-pen"></i></a> -->
                        <a href="{{ route('dashboard.movies.edit', ['id' => $movie->id]) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fa-solid fa-pen"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
                
            </table>
            <div class="m-5 pagination">
                {{ $movies->appends($request)-> links() }} 
            </div>
            
    </div>
</div>

@endsection