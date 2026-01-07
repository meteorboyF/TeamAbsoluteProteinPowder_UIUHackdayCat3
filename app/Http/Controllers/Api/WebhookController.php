<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WebhookLog;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request, $source)
    {
        try {
            WebhookLog::create([
                'source' => $source,
                'payload' => $request->all(),
                'headers' => $request->headers->all(),
                'ip_address' => $request->ip(),
            ]);

            return response()->json(['status' => 'success', 'message' => 'Webhook received']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
