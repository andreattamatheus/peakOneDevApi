<?php

namespace App\Console\Commands;

use App\Jobs\ParseEmailJob;
use App\Models\Email;
use App\Services\EmailService;
use Illuminate\Console\Command;

class ParseEmailContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse raw email content and extract plain text body content';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ParseEmailJob::dispatch();
        $this->info('All unprocessed emails have been dispatch.');
    }
}
