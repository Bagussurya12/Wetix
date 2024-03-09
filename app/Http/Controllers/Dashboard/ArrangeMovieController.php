<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use App\Models\Theater;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ArrangeMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Theater $theater)
    {
        $q = $request->input('q');
        $active = 'Theaters';

        // $theaters = Theater::when($q, function ($query) use ($q) {
        //     return $query->where('theater', 'like', '%' . $q . '%');
        // })->paginate(10);

        return view('dashboard/ArrangeMovie/list', [
            'theater' => $theater,
            'request' => $request,
            'active' => $active,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Theater $theater)
    {
        $active = 'Theaters';
        $movies = Movie::get();
        return view('dashboard/ArrangeMovie/form', [
            'theater' => $theater,
            'url' => 'dashboard.theaters.arrange.movie.store',
            'button' => 'Create',
            'movies' => $movies,
            'active' => $active,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request -> all(), [
            'studio' => 'required',
            'movie_id' => 'required',
            'price' => 'required',
            'rows' => 'required',
            'columns' => 'required',
            'schedules' => 'required',
            // 'schedule' => 'required',
            'status' => 'required'
        ]);
        if($validator -> fails()){
            return redirect()
            -> route('dashboard.theaters.arrange.movie.create', $request -> input('theater_id'))
            ->withErrors($validator)
            -> withInput();
        }else{
            
            return redirect() -> route('dashboard.theaters')
            -> with('message', 'DATA THEATER BERHASIL DITAMBAHKAN');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
