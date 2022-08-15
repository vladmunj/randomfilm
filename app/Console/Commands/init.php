<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Selenium\Web;
use App\Jobs\getMovieData;

class init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $baseUrl = 'https://www.imdb.com';

        $webService = new Web();
        $webService->nav($baseUrl.'/chart/top/?ref_=nv_mv_250');
        $links = $webService->find('.titleColumn a');

        $movieData = [];
        foreach($links as $link){
            $movieData[] = [
                'name' => $link->getText(),
                'href' => $baseUrl.$link->getAttribute('href')
            ];
        }

        $webService->quit();

        foreach($movieData as $id => $data){
            getMovieData::dispatch($data);
            unset($movieData[$id]);
        }
    }
}
