<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Email:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email spam';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
