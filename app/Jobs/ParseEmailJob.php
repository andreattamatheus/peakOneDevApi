<?php

namespace App\Jobs;

use App\Models\Email;
use App\Services\EmailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class ParseEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $emails = Email::query()->where('is_processed', false)->get();
        $emailService = new EmailService();

        try {
            foreach ($emails as $email) {
                $plainText = $emailService->extractPlainText($email->email);
                DB::transaction(function () use ($email, $plainText) {
                    $email->raw_text = $plainText;
                    $email->is_processed = true;
                    $email->save();
                });
                logger()->channel('email-parsed')->info("Processed email ID: {$email->id}");
            }
        } catch (\Exception $e) {
            logger()->channel('daily')->error('Error parsing email content: ' . $e->getMessage());
        }
    }
}
