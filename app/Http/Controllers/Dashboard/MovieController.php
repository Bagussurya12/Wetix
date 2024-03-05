<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
        {
            $q = $request->input('q');
            $active = 'Movies';

            $movies = Movie::when($q, function ($query) use ($q) {
                return $query->where('title', 'like', '%' . $q . '%');
            })->paginate(10);

            return view('dashboard.movie.list', [
                'movies' => $movies,
                'request' => $request,
                'active' => $active,
            ]);
        }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'Movies';

        return view('dashboard.movie.form', [
            'active' => $active,
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movie $movie)
    {
        $validator = Validator::make($request -> all(), [
            'title' => 'required | unique:App\Models\Movie, title',
            'description' => 'required',
            'thumbnail' => 'required | image', 
        ]);

        if($validator -> fails()){
            return redirect() -> route('dashboard.movie.create')
                                -> withErrors($validator)
                                -> withInput();
        }else{
            $image = $request -> file('thumbnail');
            $fileName = time() . '.' . $image -> getClientOriginalExtension();
            Storage::disk('local')-> putFileAs('public/movies', $image, $fileName);
            $movie -> title = $request ->input('title');
            $movie -> description = $request ->input('description');
            $movie -> thumbnail = $fileName;
            $movie ->save();

            return redirect() -> route('dashboard.movies');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}