<?php

namespace App\Http\Controllers;

use App\Services\EmailSubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class EmailSubscriptionController extends Controller
{
    public function subscribeEmail(Request $request, EmailSubscriptionService $subscriptionService): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->emailRule());
        if ($validator->fails()) return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        $email = $validator->validated()['email'];
        if ($subscriptionService->isExist($email)) return response()->json(['error' => 'Email is already subscribed'], Response::HTTP_CONFLICT);
        $subscriptionService->subscribe($email);
        return response()->json(['success' => true, 'message' => 'Email subscribed successfully'], Response::HTTP_OK);
    }

    private function emailRule(): array
    {
        return [
            'email' => 'required|regex:/^[\w]+(\.[\w-]+)*@\w+(\.[\w]+)*$/',
        ];
    }
}
