<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmailRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Http\Resources\EmailCreateResource;
use App\Http\Resources\EmailShowResource;
use App\Models\Email;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class SuccessfulEmailController extends Controller
{
    public function __construct(
        private EmailService $emailService
    ) {}

    /**
     * Handle the incoming request.
     */
    public function index(Request $request): JsonResponse|ResourceCollection
    {
        try {
            $emails = $this->emailService->getEmails($request);

            return EmailShowResource::collection($emails);
        } catch (\Exception $e) {
            logger()->channel('daily')->error('Error retrieving the email: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error retrieving the email. Contact support.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created email.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreEmailRequest $request)
    {
        try {
            $email = $this->emailService->create($request);

            return new EmailCreateResource($email);
        } catch (\Exception $e) {
            logger()->channel('daily')->error('Error creating the email: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error creating the email. Contact support.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified email.
     *
     * @param  string  $id  The ID of the email to display.
     */
    public function show(Email $email): JsonResponse|EmailShowResource
    {
        try {
            return new EmailShowResource($email);
        } catch (\Exception $e) {
            logger()->channel('daily')->error('Error getting the email: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error getting the email. Contact support.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified email.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Email $email, UpdateEmailRequest $request)
    {
        try {
            $this->emailService->updateEmail($email, $request);

            return new EmailShowResource($email);
        } catch (\Exception $e) {
            logger()->channel('daily')->error('Error updating the email: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error updating the email. Contact support.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified email.
     *
     * @param  int  $id  The ID of the email to be deleted.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Email $email): JsonResponse
    {
        try {
            $this->emailService->deleteEmail($email);

            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            logger()->channel('daily')->error('Error deleting the email: ' . $e->getMessage());

            return response()->json([
                'message' => 'Error deleting the email. Contact support.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
