<?php namespace App\Services\Jobs;

use App\Services\Selenium\Web;
use App\Models\Movie;

class getMovieDataService{
    private $input, $webService, $movieID, $posterName;

    public function __construct($input){
        $this->input = $input;
        $this->webService = new Web();
    }

    private function createMovie(){
        $this->movieID = Movie::firstOrCreate([
            'name' => $this->input['name']
        ])->id;
    }

    private function getPosterData($path){
        return pathinfo($path);
    }

    private function getPosterPath($path){
        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/)[,\d_]+.jpg)#', $path, $match);
        return end($match[0]);
    }

    private function downloadPoster(){
        $this->webService->nav($this->input['href']);
        $imageElement = $this->webService->findOne('.ipc-image');
        $path = $this->getPosterPath($imageElement->getAttribute('srcset'));
        $this->webService->quit();
        $image = file_get_contents($path);
        $info = $this->getPosterData($path);
        $this->posterName = $this->movieID.'.'.str_replace(' 380w','',$info['extension']);
        file_put_contents(public_path('posters/'.$this->posterName), $image);
    }

    public function run(){
        $this->createMovie();
        $this->downloadPoster($this->movieID);
        Movie::find($this->movieID)->update(['poster' => $this->posterName]);
    }
}