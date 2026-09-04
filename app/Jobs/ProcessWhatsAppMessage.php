<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProcessWhatsAppMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $from;
    public $messageId;
    public $messageText;

    /**
     * Create a new job instance.
     */
    public function __construct($from, $messageId, $messageText)
    {
        $this->from = $from;
        $this->messageId = $messageId;
        $this->messageText = $messageText;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("ProcessWhatsAppMessage Job started for '{$this->messageText}' from {$this->from}");

        $phoneId = config('services.whatsapp.phone_number_id', env('WHATSAPP_PHONE_NUMBER_ID', '1225789103959287'));
        $accessToken = config('services.whatsapp.access_token', env('WHATSAPP_ACCESS_TOKEN'));
        $geminiApiKey = config('services.gemini.api_key', env('GEMINI_API_KEY'));

        // 1. Mark incoming message as read
        if ($accessToken && $accessToken !== 'your_token_from_step1' && $phoneId) {
            try {
                Http::withToken($accessToken)
                    ->post("https://graph.facebook.com/v20.0/{$phoneId}/messages", [
                        'messaging_product' => 'whatsapp',
                        'status' => 'read',
                        'message_id' => $this->messageId,
                    ]);
            } catch (\Throwable $e) {
                Log::warning('WhatsApp Mark Read Failed: ' . $e->getMessage());
            }
        }

        if (empty($this->messageText)) {
            return;
        }

        // 2. Intent Detection (Check if message is a simple greeting)
        $isGreeting = $this->isGreeting($this->messageText);

        // 3. Fetch Product Catalog for AI Context
        $products = DB::table('products')->get();
        $catalogContext = [];
        $matchedProductImage = null;

        foreach ($products as $prod) {
            $fullImageUrl = $this->formatImageUrl($prod->image);

            $catalogContext[] = sprintf(
                "ID: %s | Name: %s | Category: %s | Price: ৳%s | Stock: %d | Image: %s | Details: %s",
                $prod->id,
                $prod->name,
                $prod->categoryName ?? $prod->category,
                number_format($prod->price),
                $prod->inStock ?? 10,
                $fullImageUrl ?? '',
                $prod->description ?? ''
            );

            // Match image ONLY if not a greeting and user explicitly mentions product name or ID
            if (!$isGreeting) {
                if (mb_stripos($this->messageText, $prod->name) !== false || 
                    ($prod->id && mb_stripos($this->messageText, $prod->id) !== false)) {
                    $matchedProductImage = $fullImageUrl;
                }
            }
        }

        $catalogText = implode("\n", $catalogContext);

        // 4. Generate AI Response using Gemini API (gemini-3.6-flash)
        $aiResponseText = "";
        $imageUrlToSend = $matchedProductImage;

        if ($geminiApiKey && $geminiApiKey !== 'your_gemini_api_key_here') {
            try {
                if ($isGreeting) {
                    $systemPrompt = "You are BikroyBD24's friendly, polite Bengali AI sales assistant.\n" .
                        "The customer is greeting you. Respond with a warm, natural, polite Bengali greeting:\n" .
                        "\"হ্যালো! BikroyBD24-এ আপনাকে স্বাগতম। 😊\nআমি কীভাবে আপনাকে সাহায্য করতে পারি? আপনি আমাদের স্মার্টফোন, ল্যাপটপ, ফ্যাশন বা অন্যান্য গ্যাজেটের তথ্য জানতে পারেন।\"\n" .
                        "Do NOT list product specifications, prices, or catalog items unless the customer asks about specific products.";
                } else {
                    $systemPrompt = "You are BikroyBD24's friendly, polite Bengali AI sales assistant.\n" .
                        "Always reply in natural, polite Bengali (with English product titles if appropriate).\n" .
                        "Answer questions regarding products, price, discounts, and availability using the store catalog below.\n" .
                        "If the customer asks for a product image or is interested in a specific product, include [IMAGE_URL: <image_link>] at the end of your response.\n\n" .
                        "Current BikroyBD24 Catalog:\n" . $catalogText;
                }

                $geminiPayload = [
                    'contents' => [
                        [
                            'role' => 'user',
                            'parts' => [
                                ['text' => $systemPrompt],
                                ['text' => "Customer Message: " . $this->messageText]
                            ]
                        ]
                    ]
                ];

                $geminiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key={$geminiApiKey}";
                $geminiResponse = Http::withHeaders(['Content-Type' => 'application/json'])->post($geminiUrl, $geminiPayload);

                Log::info("2. Gemini Response Status: " . $geminiResponse->status() . " Body: " . $geminiResponse->body());

                if ($geminiResponse->successful()) {
                    $resData = $geminiResponse->json();
                    $aiResponseText = $resData['candidates'][0]['content']['parts'][0]['text'] ?? '';
                } else {
                    Log::error("Gemini API Request Failed: Status " . $geminiResponse->status() . " Body: " . $geminiResponse->body());
                }
            } catch (\Throwable $e) {
                Log::error('Gemini API Exception: ' . $e->getMessage());
            }
        }

        // Fallback response if Gemini API key is unconfigured or fails
        if (empty($aiResponseText)) {
            if ($isGreeting) {
                $aiResponseText = "হ্যালো! BikroyBD24-এ আপনাকে স্বাগতম। 😊\n" .
                    "আমি আপনার শপিং অ্যাসিস্ট্যান্ট। আমি কীভাবে আপনাকে সাহায্য করতে পারি?\n" .
                    "আপনি আমাদের ল্যাপটপ, মোবাইল বা অন্যান্য গ্যাজেটের তথ্য জানতে পারেন।";
            } else {
                $aiResponseText = "হ্যালো! BikroyBD24-এ আপনাকে স্বাগতম। 😊\n" .
                    "আমি আপনার শপিং অ্যাসিস্ট্যান্ট। কিভাবে আপনাকে সাহায্য করতে পারি?\n" .
                    "আমাদের কাছে স্মার্টফোন, ল্যাপটপ, ফ্যাশন এবং হোম অ্যাপ্লায়েন্সের সেরা ডিল রয়েছে।\n" .
                    "পণ্য ও অর্ডারের সহায়তার জন্য কল করুন: 01854-288311।";
            }
        }

        // Parse image URL from Gemini output if present
        if (preg_match('/\[IMAGE_URL:\s*(https?:\/\/[^\]]+)\]/i', $aiResponseText, $imgMatches)) {
            $parsedImage = trim($imgMatches[1]);
            $imageUrlToSend = $this->formatImageUrl($parsedImage);
            $aiResponseText = preg_replace('/\[IMAGE_URL:\s*https?:\/\/[^\]]+\]/i', '', $aiResponseText);
        }

        $cleanAiText = trim($aiResponseText);

        // 5. Send AI Text Message via Meta Graph API
        if ($accessToken && $accessToken !== 'your_token_from_step1' && $phoneId) {
            try {
                $textPayload = [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'to' => $this->from,
                    'type' => 'text',
                    'text' => [
                        'body' => $cleanAiText
                    ]
                ];

                $metaResponse = Http::withToken($accessToken)
                    ->post("https://graph.facebook.com/v20.0/{$phoneId}/messages", $textPayload);

                Log::info("3. Meta Outgoing Status: " . $metaResponse->status() . " Body: " . $metaResponse->body());

                if ($metaResponse->failed()) {
                    Log::error("Meta send failed: Status " . $metaResponse->status() . " Body: " . $metaResponse->body());
                }

                // 6. Send Product Image Media Message ONLY if matching product is requested
                if ($imageUrlToSend && !$isGreeting) {
                    $imagePayload = [
                        'messaging_product' => 'whatsapp',
                        'recipient_type' => 'individual',
                        'to' => $this->from,
                        'type' => 'image',
                        'image' => [
                            'link' => $imageUrlToSend
                        ]
                    ];

                    $imgMetaResponse = Http::withToken($accessToken)
                        ->post("https://graph.facebook.com/v20.0/{$phoneId}/messages", $imagePayload);

                    Log::info("3b. Meta Outgoing Image Status: " . $imgMetaResponse->status() . " Body: " . $imgMetaResponse->body());

                    if ($imgMetaResponse->failed()) {
                        Log::error("Meta image send failed: Status " . $imgMetaResponse->status() . " Body: " . $imgMetaResponse->body());
                    }
                }
            } catch (\Throwable $e) {
                Log::error('WhatsApp Send Message Exception: ' . $e->getMessage());
            }
        } else {
            Log::warning("WhatsApp Send Skipped: WHATSAPP_ACCESS_TOKEN or WHATSAPP_PHONE_NUMBER_ID is missing or set to placeholder in .env");
        }
    }

    /**
     * Detect if message is a simple greeting.
     */
    protected function isGreeting(string $text): bool
    {
        $normalized = mb_strtolower(trim($text));

        $greetings = [
            'hi', 'hello', 'hey', 'hlo', 'hei', 'hy',
            'কেমন আছেন', 'কেমন আছেন?', 'কেমন আছো', 'কেমন আছো?',
            'সালাম', 'আসসালামু আলাইকুম', 'assalamu alaikum', 'assalamualaykum',
            'hello bikroybd', 'hi bikroybd', 'kemon achen', 'kemon asen',
            'help', 'সাহায্য'
        ];

        if (in_array($normalized, $greetings)) {
            return true;
        }

        if (mb_strlen($normalized) <= 15) {
            foreach (['hi', 'hello', 'hey', 'সালাম', 'কেমন আছেন'] as $g) {
                if (mb_strpos($normalized, $g) !== false && mb_strlen($normalized) <= mb_strlen($g) + 5) {
                    return true;
                }
            }
        }

        return false;
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
