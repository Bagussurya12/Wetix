<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theaters</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

@extends('layouts.dashboard')

@section('content')

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="font-weight-bold">Theater</h3>
        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa-solid fa-trash" style="color: #f2e8e8;"></i></button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 offset-md-2 p-2">
                <form method="post" action="{{ route($url, $theater-> id ?? '') }}" enctype="multipart/form-data">
                    @csrf
                        @if(isset($theater))
                        @method('put')
                    @endif
                    <div class="form-group">
                        <label for="theater">Theater</label>
                        <input type="text" class="form-control @error('theater') {{'is-invalid'}} @enderror" name="theater" value="{{ old('theater') ?? $theater -> theater ?? ''}} ">
                        @error('theater')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
        
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" class="form-control @error('address') {{'is-invalid'}} @enderror">{{ old('address') ?? $theater -> address ?? ''}}</textarea>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div >
                        <div class="form-group">
                            <label for="status">Status</label>
                        </div>    
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" id="active" class="form-check-input" value="active" @if ((old('status') ?? $theater-> status?? '' )  == 'active') checked @endif>
                                    <label for="active" class="form-check-label">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" id="inactive" class="form-check-input" value="inactive" @if ((old('status') ?? $theater->status   ?? '') == 'inactive') checked @endif>
                                    <label for="inactive" class="form-check-label">Inactive</label>
                                </div>        
                    </div>
                  @error('status')
                  <span class="text-danger mb-5" >{{ $message }}</span>
                  @enderror
                    <div class="form-group mb-0 mt-5">
                        <button class="btn btn-sm btn-warning mt-1" type="button" onclick="window.history.back()">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm mt-1">{{$button}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if(isset($theater))

    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                <p>Anda Yakin Ingin Hapus {{$theater->theater ?? ''}} ?</p>
                </div>
                
                <div class="modal-footer">
                <form action="{{ route('dashboard.theaters.delete', $theater->id)  }}" method="post">
                    @csrf
                    @method('delete')
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="theater_id" value="{{$theater->id}}">
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash" style="color: #f2e8e8;"></i></button>
                </form>


                </div>
            </div>
        </div>
    </div>
@endif

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
