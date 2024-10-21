<?php

namespace App\Services;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EmailService
{
    /**
     * Create a new email based on the provided request.
     */
    public function create(Request $request): Email
    {
        try {
            return DB::transaction(function () use ($request) {
                return Email::query()->create(
                    $request->validated()
                );
            });
        } catch (\Exception $e) {
            throw new \Exception('Error creating email: ' . $e->getMessage());
        }
    }

    /**
     * Update the email address for a given user.
     */
    public function updateEmail(Email $email, Request $request): void
    {
        try {
            DB::transaction(function () use ($email, $request) {
                $email->update($request->validated());
            });
        } catch (\Exception $e) {
            throw new \Exception('Error updating email: ' . $e->getMessage());
        }
    }

    /**
     * Retrieve a list of emails based on the provided request parameters.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing query parameters.
     */
    public function getEmails(Request $request): LengthAwarePaginator
    {
        try {
            return Email::query()
                ->whereBetween('created_at', [$request->get('start_date', now()->startOfDay()), $request->get('end_date', now()->endOfDay())])
                ->paginate($request->get('per_page', 10));
        } catch (\Exception $e) {
            throw new \Exception('Error retrieving emails: ' . $e->getMessage());
        }
    }

    /**
     * Deletes an email by its ID.
     */
    public function deleteEmail(Email $email): void
    {
        try {
            DB::transaction(function () use ($email) {
                $email->delete();
            });
        } catch (\Exception $e) {
            throw new \Exception('Error deleting email: ' . $e->getMessage());
        }
    }

    /**
     * Extract plain text from raw email content.
     */
    public function extractPlainText($rawEmail): string
    {
        $plainText = strip_tags($rawEmail);
        $plainText = preg_replace('/[^\P{C}\n]+/u', '', $plainText);
        $plainText = preg_replace('/\s+/', ' ', $plainText);

        return trim($plainText);
    }
}
