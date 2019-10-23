<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'crate records in database';

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
        // factory(\App\Post::class, 5)->create();
        factory(\App\Post::class, 20)->create();
    }
}
