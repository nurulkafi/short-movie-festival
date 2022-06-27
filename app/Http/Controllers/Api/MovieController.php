<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Movie::paginate(5);
        return response([
            'success' => true,
            'message' => 'List Movie',
            'data' => $data
        ], 200);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $title=$request->title;
        $description=$request->description;
        $duration=$request->duration;
        $artists=$request->artists;
        $genres=$request->genres;
        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'artists' => 'required',
            'genres' => 'required'
        ]);
        if ($validated->fails()){
            return response([
                'success' => false,
                'message' => $validated->errors()

            ], 400);
        }
        $saved = Movie::create([
            'title' => $title,
            'description' => $description,
            'duration' => $duration,
            'artists' => $artists,
            'genres' => $genres
        ]);
        if ($saved) {
            return response([
                'success' => true,
                'message' => 'Add Movie Success'
            ], 200);
        }else{
            return response([
                'success' => false,
                'message' => 'Add Movie Failed'
            ], 400);
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
        $movie = Movie::findOrFail($id);
        $title = $request->title;
        $description = $request->description;
        $duration = $request->duration;
        $artists = $request->artists;
        $genres = $request->genres;
        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'artists' => 'required',
            'genres' => 'required'
        ]);
        if ($validated->fails()) {
            return response([
                'success' => false,
                'message' => $validated->errors()

            ], 400);
        }

        $movie->update([
            'title' => $title,
            'description' => $description,
            'duration' => $duration,
            'artists' => $artists,
            'genres' => $genres
        ]);
        if ($movie) {
            return response([
                'success' => true,
                'message' => 'Update Movie Success'
            ], 201);
        } else {
            return response([
                'success' => false,
                'message' => 'Update Movie Failed'
            ], 400);
        }
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
    public function search($search){
        $movie = Movie::where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('artists', 'like', '%' . $search . '%')
                ->orWhere('genres', 'like', '%' . $search . '%')
                ->get();
        if (count($movie) > 0) {
            return response([
                'success' => true,
                'message' => 'List Movie',
                'data' => $movie
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => 'Not Found'
            ], 200);
        }
    }
}
