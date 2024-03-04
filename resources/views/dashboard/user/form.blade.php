<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

@extends('layouts.dashboard')

@section('content')

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="font-weight-bold">Users</h3>
        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa-solid fa-trash" style="color: #f2e8e8;"></i></button>
    </div>
    <div class="card-body">
           <div class="row">
            <div class="col-md-8 offset-md-2 p-2">
                <form method="post" action="{{url('dashboard/user/update/'. $user ->id)}}">
                    @csrf 
                    @method('put')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{$user -> name}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" value="{{old('email') ?? $user -> email}}">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group   mb-0">
                        <button class="btn btn-sm btn-warning mt-1" type="button" onclick="window.history.back()">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm mt-1">Update</button>
                    </div>
                </form>
            </div>
           </div>
    </div>
</div>
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
               <p>Anda Yakin Ingin Hapus {{$user->name}}</p>
            </div>
            
            <div class="modal-footer">
             <form action="{{ url('dashboard/user/delete/'.$user->id) }}" method="POST">
                 @csrf
                    <input type="hidden" name="_method" value="DELETE"> <!-- Gunakan _method untuk menetapkan metode DELETE -->
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash" style="color: #f2e8e8;"></i></button>
            </form>


            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#deleteModal').on('shown.bs.modal', function () {
            // Fokus ke tombol delete ketika modal ditampilkan
            $('#deleteModal').find('button[type="submit"]').focus();
        });
    });
</script>

</body>
</html>
