@extends('layouts.dashboard')

@section('content')

<div class="card mt-4">
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <h3 class="font-weight-bold align-self-center">Users</h3>
            </div>
            <div class="col-4">
                <form method="get" action="{{url('dashboard/user')}}">
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
        @if($users -> total())
            <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                    <th>Edited</th>
                    <th>Action</th>
                </tr>
            </thead>   
    
            <tbody>
                {{-- @foreach ($users as $user) --}}
                <tr>
                    <th scope="row">{{($users -> currentPage()-1) * $users -> perPage() + $loop -> iteration}}</th>
                    <td>{{$user -> name}}</td>
                    <td>{{$user -> email}}</td>
                    <td>{{$user -> created_at}}</td>
                    <td>{{$user -> updated_at}}</td>
                    <td>
                        <!-- <a href="{{ url('dashboard/user/edit/'.$user->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fa-solid fa-pen"></i></a> -->
                        <a href="{{ route('dashboard.user.edit', ['id' => $user->id]) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fa-solid fa-pen"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
                
            </table>
            <div class="m-5 pagination">
                {{ $users->appends($request)-> links() }} 
            </div>
            {{-- @else
            <h5 class="text-center fw-bold p-3"> Data User Tidak Tersedia </h5>
            @endif --}}
    </div>
</div>

@endsection