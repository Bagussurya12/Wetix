@extends('layouts.dashboard')

@section('content')
<div class="mb-2">
    {{-- <a href="{{ route('dashboard.theaters.create') }}" class="btn btn-success btn-sm"> + thaters</a> --}}
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
                <h3 class="font-weight-bold align-self-center">Theaters</h3>
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
        @if($theaters -> total())
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Theater;</th>
                        <th>Address</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>   
        
                <tbody>
                    @foreach ($theaters as $theater)
                    <tr>
                      
                       
                        <td>
                            <h5><strong>{{$theater -> theater}}</strong></h5>
                        </td>
                        <td>{{$theater -> address}}</td>
                        <td>
                            <a href="{{ route('dashboard.theaters.edit', $theater->id) }}" class="btn btn-warning btn-sm" title="edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </td>
                        

                    </tr>
                    @endforeach
                </tbody>
                
            </table>

            <div class="m-5 pagination">
                {{-- {{ $theaters->appends($request)-> links() }}  --}}
            </div>
            @else 
                <h5 class="text-center fw-bold p-3"> Data Theaters Tidak Tersedia </h5>
            
            @endif
    </div>
</div>

@endsection

<script>
    document.getElementById("closeAlert").addEventListener("click", function() {
        document.getElementById("alertSuccess").style.display = "none";
    });
</script>