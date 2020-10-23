<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

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
        \Log::info("Cron Job is working fine");
     
      $client = new \GuzzleHttp\Client();
        $request = $client->get('http://3.6.147.217:8080/api/task_schedule');
        $response = $request->getBody()->getContents();
        // return $response;
      
        $this->info('Demo:Cron Cummand Run successfully!');
    }
}
