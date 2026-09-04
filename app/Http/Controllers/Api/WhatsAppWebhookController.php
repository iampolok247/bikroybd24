<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessWhatsAppMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WhatsAppWebhookController extends Controller
{
    /**
     * Handle both GET (Hub Verification) and POST (Event Webhook) requests.
     */
    public function handle(Request $request)
    {
        // 1. Handle Meta GET Verification
        if ($request->isMethod('get') || $request->has('hub_challenge')) {
            return $this->verify($request);
        }

        // 2. Ignore Statuses & Non-Message Payloads Immediately (<5ms)
        if (isset($request->entry[0]['changes'][0]['value']['statuses'])) {
            return response()->json(['status' => 'status_ignored'], 200);
        }

        $messages = $request->entry[0]['changes'][0]['value']['messages'] ?? null;
        if (!$messages || !isset($messages[0])) {
            return response()->json(['status' => 'no_message'], 200);
        }

        $message = $messages[0];
        $from = $message['from'] ?? null;
        $messageId = $message['id'] ?? null;
        $messageText = trim($message['text']['body'] ?? '');

        if (!$from || !$messageId) {
            return response()->json(['status' => 'no_message'], 200);
        }

        // 3. Avoid Duplicates & Cache Deduplication (10 Minutes TTL)
        if (Cache::has("wa_msg_{$messageId}")) {
            Log::info("Duplicate WhatsApp message received (Ignored): {$messageId}");
            return response()->json(['status' => 'duplicate'], 200);
        }
        Cache::put("wa_msg_{$messageId}", true, now()->addMinutes(10));

        Log::info("1. Webhook received incoming text: '{$messageText}' from: {$from} (ID: {$messageId}). Dispatching background job...");

        // 4. Dispatch Async Background Job for Gemini AI & WhatsApp Dispatch
        ProcessWhatsAppMessage::dispatch($from, $messageId, $messageText);

        // 5. FastCGI Connection Flushing for Instant HTTP 200 Delivery (<50ms)
        if (function_exists('fastcgi_finish_request')) {
            response()->json(['status' => 'success'], 200)->send();
            fastcgi_finish_request();
        }

        // 6. Return Immediate HTTP 200 OK Response to Meta
        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Verify Meta Hub Challenge Token.
     */
    public function verify(Request $request)
    {
        $mode = $request->query('hub_mode');
        $token = $request->query('hub_verify_token');
        $challenge = $request->query('hub_challenge');

        $verifyToken = config('services.whatsapp.verify_token', env('WHATSAPP_VERIFY_TOKEN', 'bikroybd_secret_token_2026'));

        if ($mode === 'subscribe' && $token === $verifyToken) {
            return response($challenge, 200)->header('Content-Type', 'text/plain');
        }

        return response('Forbidden', 403);
    }
}
