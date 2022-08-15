<?php namespace App\Services\Jobs;

use App\Services\Selenium\Web;
use App\Models\Movie;

class getMovieSourceService{
    private $movie, $webService, $source;

    const DICTIONARY = [
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'e',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'j',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'x',
        'ц' => 'c',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'shh',
        'ъ' => '',
        'ы' => 'y',
        'ь' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',
        ' ' => '-'
    ];

    public function __construct($movie){
        $this->movie = $movie;
        $this->webService = new Web();
    }

    private function getSource(){
        $this->webService->nav('https://gidonline.io/film/'.$this->translate().'/');
        try{
            $videoElement = $this->webService->findOne('.ifram');
        }catch(\Exception $e){
            $this->webService->quit();
        }
        $this->source = $videoElement->getAttribute('src');
        $this->webService->quit();
    }

    private function translate(){
        $letters = mb_str_split($this->movie->name);
        $result = '';
        foreach($letters as $letter){
            $result .= (isset(self::DICTIONARY[mb_strtolower($letter)]) ? self::DICTIONARY[mb_strtolower($letter)] : strtolower($letter));
        }
        return $result;
    }

    private function setSource(){
        $this->movie->update(['video_link' => $this->source]);
    }

    public function run(){
        dump($this->movie->id);
        $this->getSource();
        $this->setSource();
    }
}