<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\getMovieSource;
use App\Models\Movie;

class source extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:source';

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
        $movies = Movie::whereNull('video_link')->get();
        foreach($movies as $movie){
            getMovieSource::dispatch($movie);
        }
    }
}
