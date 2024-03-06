<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



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
        $url = route('dashboard.movies.store'); // Menentukan URL untuk action form saat membuat movie baru
    
        return view('dashboard.movie.form', [
            'active' => $active,
            'url' => $url, // Mengirimkan variabel $url ke view
            'button' => 'Create', // Menentukan label tombol
            'url' => 'dashboard.movies.store',
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:movies,title',
            'description' => 'required',
            'thumbnail' => 'required|image', 
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

            return redirect() -> route('dashboard.movies')->with('message', 'Data Movie Berhasil Ditambahkan');
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
    public function edit(Movie $movie )
    {
        $active = 'Movies';
        $url = route('dashboard.movies.update', $movie->id); // Menentukan URL untuk action form saat mengedit movie
    
        return view('dashboard/movie/form', [
            'active' => $active,
            'movie' => $movie,
            'button' => 'Update', // Menentukan label tombol
            'url' => 'dashboard.movies.update', // Mengirimkan variabel $url ke view
        ]);
        
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        
        

        if($validator -> fails()){
            return redirect() -> route('dashboard.movies.update', $movie -> id)
                                -> withErrors($validator)
                                -> withInput();
        }else{
            if($request -> hasFile('thumbnail')){
                $image = $request -> file('thumbnail');
                $fileName = time() . '.' . $image -> getClientOriginalExtension();
                Storage::disk('local')-> putFileAs('public/movies', $image, $fileName);

                $movie -> thumbnail = $fileName;
            }
 
            $movie -> title = $request ->input('title');
            $movie -> description = $request ->input('description');
            
            $movie ->save();

            return redirect() -> route('dashboard.movies')->with('message', 'Data Movie Berhasil Diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie -> delete();

        return redirect()
                -> route('dashboard.movies')->with('message', 'Data Movie Berhasil Dihapus');
    }
}
