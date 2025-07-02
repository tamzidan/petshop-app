<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZenzivaService
{
    protected $userkey;
    protected $passkey;
    protected $brandName;
    protected $waOfficialApiUrl;

    public function __construct()
    {
        $this->userkey = config('services.zenziva.userkey');
        $this->passkey = config('services.zenziva.passkey');
        $this->brandName = config('services.zenziva.brand_name');
        $this->waOfficialApiUrl = config('services.zenziva.wa_official_api_url');

        // Pastikan konfigurasi penting ada
        if (empty($this->userkey) || empty($this->passkey) || empty($this->brandName) || empty($this->waOfficialApiUrl)) {
            Log::error('Zenziva WhatsApp API credentials or brand name missing in config.');
            throw new \Exception('Zenziva WhatsApp API credentials or brand name not configured.');
        }
    }

    /**
     * Mengirim OTP menggunakan Zenziva WhatsApp Official API.
     *
     * @param string $phoneNumber Nomor telepon tujuan (tanpa '+', dimulai dengan kode negara, misal: 62812xxxx).
     * Perhatikan: Zenziva contohnya menggunakan 08xxxx, sesuaikan jika perlu.
     * Kita akan tetap menggunakan 628xxxx.
     * @param string $otpCode Kode OTP (Numerik, Maksimal 10 karakter).
     * @return array Respon dari Zenziva.
     */
    public function sendWhatsAppOfficialOtp(string $phoneNumber, string $otpCode): array
    {
        // Pastikan nomor telepon sesuai format Zenziva (misal: dari 628xxxx jadi 08xxxx jika diminta)
        // Berdasarkan contoh request Zenziva: $telepon = '081111111111';
        // Asumsi nomor di DB kita 628xx, jadi perlu diubah
        $formattedPhoneNumber = preg_replace('/^62/', '0', $phoneNumber); // Ubah 628xx menjadi 08xx

        try {
            $response = Http::timeout(30)->post($this->waOfficialApiUrl, [
                'userkey' => $this->userkey,
                'passkey' => $this->passkey,
                'to' => $formattedPhoneNumber,
                'brand' => $this->brandName,
                'otp' => $otpCode,
            ]);

            // Log raw response untuk debugging
            Log::info("Zenziva WhatsApp OTP Response to {$formattedPhoneNumber}:", [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            // Respon dari API WhatsApp Official adalah JSON
            $responseData = $response->json();

            if ($response->successful() && isset($responseData['status']) && $responseData['status'] == '1') {
                return [
                    'status' => 'success',
                    'message' => $responseData['text'] ?? 'OTP sent successfully.',
                    'message_id' => $responseData['messageId'] ?? null,
                    'raw_response' => $responseData
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => $responseData['text'] ?? 'Failed to send OTP via WhatsApp. Status: ' . ($responseData['status'] ?? 'N/A'),
                    'raw_response' => $responseData
                ];
            }

        } catch (\Exception $e) {
            Log::error('Zenziva WhatsApp OTP failed: ' . $e->getMessage(), [
                'phone_number' => $phoneNumber,
                'otp_code' => $otpCode,
                'exception' => $e->getMessage()
            ]);
            return [
                'status' => 'error',
                'message' => 'Failed to send OTP. Please try again.',
                'exception' => $e->getMessage()
            ];
        }
    }
}