<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PrepareFreshProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare a fresh project setup.';

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
        $this->call('migrate:reset');
        $this->call('migrate');
        $this->call('db:seed');
    }
}
