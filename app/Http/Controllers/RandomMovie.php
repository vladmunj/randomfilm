<?php namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class RandomMovie{
    public function page(){
        $movie = Movie::whereNotNull([
            'video_link','poster'
        ])->get()->random();
        return view('web.main',['movie'=>$movie]);
    }

    public function watch(Request $request){
        $movie = Movie::find($request->id);
        return view('web.watch',['movie'=>$movie]);
    }
}