<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LiveChatController extends Controller
{
    /**
     * Get Chatbot configuration (Support hotline phone, suggested queries).
     */
    public function getConfig()
    {
        return response()->json([
            'status' => 'success',
            'support_phone' => env('WHATSAPP_SUPPORT_PHONE', '8801854288311'),
            'whatsapp_url' => 'https://wa.me/' . env('WHATSAPP_SUPPORT_PHONE', '8801854288311') . '?text=' . urlencode('Hello BikroyBD24, I need assistance with an order.'),
            'quick_actions' => [
                'পণ্য দেখতে চাই',
                'অর্ডার করার নিয়ম',
                'ডেলিভারি চার্জ কত?',
                'সরাসরি যোগাযোগ'
            ]
        ]);
    }

    /**
     * Handle incoming native website live chat messages using Pure Dynamic Gemini AI.
     */
    public function sendMessage(Request $request)
    {
        $userMessage = trim($request->input('message', ''));
        $history = $request->input('history', []);

        if (empty($userMessage)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Message content cannot be empty.'
            ], 422);
        }

        $geminiApiKey = config('services.gemini.api_key', env('GEMINI_API_KEY'));

        // 1. Lightweight Minimal Catalog Context
        $products = DB::table('products')->select('id', 'name', 'price', 'image', 'inStock')->get();
        $catalogContext = [];
        $matchedProductImage = null;

        foreach ($products as $prod) {
            $fullImageUrl = $this->formatImageUrl($prod->image);

            $catalogContext[] = sprintf(
                "%s (৳%s, Stock:%s)",
                $prod->name,
                number_format($prod->price),
                ($prod->inStock ?? 1) ? 'Yes' : 'No'
            );

            if (mb_stripos($userMessage, $prod->name) !== false || 
                ($prod->id && mb_stripos($userMessage, $prod->id) !== false)) {
                $matchedProductImage = $fullImageUrl;
            }
        }

        $catalogText = implode("; ", $catalogContext);

        // 2. Direct Dynamic System Instruction (Zero Keyword Interception)
        $systemInstruction = "You are the dynamic AI assistant for BikroyBD24. Reply naturally in Bengali to whatever the customer says. If they ask 'kamon asen', reply politely as a friendly assistant. If they ask about products, answer based on store products. NEVER return canned/static sales pitches unless requested.\n\n" .
            "BikroyBD24 Store Information:\n" .
            "- Delivery: Dhaka 70 Tk, Outside 130 Tk. Free delivery over 2500 Tk.\n" .
            "- Hotline & WhatsApp: 01854-288311\n" .
            "- Ordering Steps: Select product -> Click Buy Now/Add to Cart -> Provide address -> Cash on Delivery/bKash.\n" .
            "- Active Product Catalog: " . $catalogText . "\n\n" .
            "If a specific product matches or is requested, include [IMAGE_URL: <image_link>] at the end of your response.";

        $aiReplyText = "";
        $imageUrlToSend = $matchedProductImage;

        if ($geminiApiKey && $geminiApiKey !== 'your_gemini_api_key_here') {
            try {
                $contents = [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => $systemInstruction]
                        ]
                    ]
                ];

                // Append last 4 chat exchanges from history
                if (is_array($history) && count($history) > 0) {
                    foreach (array_slice($history, -4) as $msg) {
                        $role = ($msg['sender'] ?? 'user') === 'user' ? 'user' : 'model';
                        $text = trim($msg['text'] ?? '');
                        if (!empty($text)) {
                            $contents[] = [
                                'role' => $role,
                                'parts' => [
                                    ['text' => $text]
                                ]
                            ];
                        }
                    }
                }

                // Append current user message directly
                $contents[] = [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $userMessage]
                    ]
                ];

                $geminiPayload = [
                    'contents' => $contents,
                    'generationConfig' => [
                        'maxOutputTokens' => 500,
                        'temperature' => 0.4,
                    ]
                ];

                // Model priority array with 15s timeout
                $modelsToTry = [
                    'gemini-3.6-flash',
                    'gemini-3.5-flash',
                    'gemini-3.1-flash-lite',
                    'gemini-flash-latest'
                ];

                foreach ($modelsToTry as $model) {
                    $geminiUrl = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$geminiApiKey}";
                    $response = Http::timeout(15)->withHeaders(['Content-Type' => 'application/json'])->post($geminiUrl, $geminiPayload);

                    if ($response->successful()) {
                        $resData = $response->json();
                        $aiReplyText = $resData['candidates'][0]['content']['parts'][0]['text'] ?? '';
                        if (!empty($aiReplyText)) {
                            Log::info("LiveChat Dynamic Gemini call successful using model: {$model}");
                            break;
                        }
                    } else {
                        Log::warning("LiveChat Gemini Model ({$model}) Failed: Status " . $response->status() . " Body: " . $response->body());
                    }
                }
            } catch (\Throwable $e) {
                Log::error('LiveChat Gemini Exception: ' . $e->getMessage());
            }
        } else {
            Log::warning('LiveChat Gemini API Key missing or invalid in .env');
        }

        // If Gemini API fails, log exact failure
        if (empty($aiReplyText)) {
            Log::error("Gemini API generation failed completely for user message: '{$userMessage}'");
            $aiReplyText = "দুঃখিত, সংযোগে সমস্যা দেখা দিয়েছে। সরাসরি আমাদের সাথে কথা বলুন: 01854-288311।";
        }

        // Parse image URL from Gemini output if present
        if (preg_match('/\[IMAGE_URL:\s*(https?:\/\/[^\]]+)\]/i', $aiReplyText, $imgMatches)) {
            $parsedImage = trim($imgMatches[1]);
            $imageUrlToSend = $this->formatImageUrl($parsedImage);
            $aiReplyText = preg_replace('/\[IMAGE_URL:\s*https?:\/\/[^\]]+\]/i', '', $aiReplyText);
        }

        return response()->json([
            'status' => 'success',
            'reply' => trim($aiReplyText),
            'image' => $imageUrlToSend,
            'quick_actions' => [
                'পণ্য দেখতে চাই',
                'অর্ডার করার নিয়ম',
                'ডেলিভারি চার্জ কত?',
                'সরাসরি যোগাযোগ'
            ]
        ]);
    }

    /**
     * Helper to format product image URLs dynamically using APP_URL.
     */
    protected function formatImageUrl($imagePath)
    {
        if (empty($imagePath)) {
            return null;
        }

        if (str_starts_with($imagePath, 'http://') || str_starts_with($imagePath, 'https://')) {
            return $imagePath;
        }

        return url($imagePath);
    }
}
