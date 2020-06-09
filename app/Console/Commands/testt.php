<?php

namespace App\Console\Commands;

use App\Post;
use Illuminate\Console\Command;

class testt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testt';

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
     * @return mixed
     */
    public function handle()
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            $post->image = 'image (' . rand(1, 22) . ').jpg';
            $post->save();
        }
        $this->line('done');
    }
}
