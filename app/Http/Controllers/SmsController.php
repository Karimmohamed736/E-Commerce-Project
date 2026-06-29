<?php

namespace App\Http\Controllers;

use App\Services\SmsService;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    protected SmsService $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function send(Request $request)
    {
        $result = $this->smsService->send(
            '201026222818',
            'Hello, this is a test message from Laravel application using SmsService.
            '
        );

        return response()->json($result);
    }
}
