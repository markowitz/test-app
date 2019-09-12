<?php

namespace App\Http\Controllers;

use App\Jobs\sendSMS;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public $client;

    public function sendMessage(Request $request)
    {
        $validatedData = $request->validate([
            'phone_number' => 'required|numeric',
            'message' => 'required|string',
        ]);

        $post_params = [
            'msisdn' => $validatedData['phone_number'],
            'message' => $validatedData['message'],
        ];

        $job = sendSMS::dispatch($post_params)->delay(now()->addSeconds(5));
        return 'success';
    }
}
