<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Mail\Mailable;

class ZohoMailService {

    protected $fromAddress;

    public function __construct() {
        $this->fromAddress = config('services.zoho.from');
    }

    public function sendMailable(string $to,Mailable $mailable): array {
        $accessToken = $this->getAccessToken();

        // Set the recipient manually
        $mailable->to($to);

        // Render the mailable to HTML
        $html = $mailable->render();

        // Extract subject from the mailable
        $subject = $mailable->subject ?? 'No Subject';

        $response = Http::withHeaders([
                    'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
                    'Content-Type' => 'application/json',
                ])->post('https://mail.zoho.com/api/accounts/5216502000000008002/messages', [
            'fromAddress' => $this->fromAddress,
            'toAddress' => $to,
            'subject' => $subject,
            'content' => $html,
        ]);

        return [
            'status' => $response->status(),
            'body' => $response->json(),
        ];
    }

    protected function getAccessToken(): string {
        return Cache::remember('zoho_access_token', 3500, function () {
                    $response = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
                        'refresh_token' => config('services.zoho.refresh_token'),
                        'client_id' => config('services.zoho.client_id'),
                        'client_secret' => config('services.zoho.client_secret'),
                        'grant_type' => 'refresh_token',
                    ]);

                    if (!$response->successful()) {
                        throw new \Exception('Failed to refresh Zoho access token: ' . $response->body());
                    }

                    return $response->json()['access_token'];
                });
    }
}
