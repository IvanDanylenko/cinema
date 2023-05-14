<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movie\Save;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::query()
            ->with(['country', 'genres'])
            ->get();
        return view('movies.index', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        $genres = Genre::all();
        return view('movies.form', [
            'movie'     => null,
            'countries' => $countries,
            'genres'    => $genres,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Save $request)
    {
        $data = $request->validated();
        try {
            $movie = new Movie($data);
            $movie->country()->associate($data['country_id']);
            $movie->save();
            $movie->genres()->sync($data['genre_ids']);
        } catch (QueryException $e) {
            return redirect()->back()->withErrors([
                'system' => $e->getMessage(),
            ]);
        }

        return redirect()->route('movies.index')->with('created', $movie->getKey());
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        $movie->load(['country', 'genres']);

        return view('movies.show', [
            'movie' => $movie,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $movie->load(['country', 'genres']);

        $countries = Country::all();
        $genres = Genre::all();

        return view('movies.form', [
            'movie'     => $movie,
            'countries' => $countries,
            'genres'    => $genres,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Save $request, Movie $movie)
    {
        $data = $request->validated();
        try {
            $movie->fill($data);
            $movie->country()->associate($data['country_id']);
            $movie->save();
            $movie->genres()->sync($data['genre_ids']);
        } catch (QueryException $e) {
            return redirect()->back()->withErrors([
                'system' => $e->getMessage(),
            ]);
        }

        return redirect()->route('movies.index')->with('updated', $movie->getKey());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $key = $movie->getKey();

        try {
            $movie->delete();
        } catch (QueryException $e) {
            return redirect()->back()->withErrors([
                'system' => $e->getMessage(),
            ]);
        }

        return redirect()->route('movies.index')->with('deleted', $key);
    }
}
