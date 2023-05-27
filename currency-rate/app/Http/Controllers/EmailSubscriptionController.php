<?php

namespace App\Http\Controllers;

use App\Services\EmailSubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class EmailSubscriptionController extends Controller
{
    public function subscribeEmail(Request $request, EmailSubscriptionService $subscriptionService): JsonResponse
    {
        $email = $request->get('email');
        if (empty($email)) return response()->json(['error' => 'No email address was provided'], Response::HTTP_BAD_REQUEST);
        if ($subscriptionService->isExist($email)) return response()->json(['error' => 'Email is already subscribed'], Response::HTTP_CONFLICT);
        $subscriptionService->subscribe($email);
        return response()->json(['success' => true, 'message' => 'Email subscribed successfully'], Response::HTTP_OK);
    }
}
