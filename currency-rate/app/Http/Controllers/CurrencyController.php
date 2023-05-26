<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Services\CurrencyService;

class CurrencyController extends Controller
{
    public function getCurrencyRate(Request $request, CurrencyService $currencyService): Response
    {
        $fromCurrency = 'BTC';
        $toCurrency = 'UAH';
        try {
            $response = $currencyService->getCurrencyRate($fromCurrency, $toCurrency);
            $status = Response::HTTP_OK;
        }
        catch (\Throwable $e) {
            $response = $e->getMessage();
            $status = Response::HTTP_BAD_REQUEST;
        }
        return response($response, $status);
    }
}
