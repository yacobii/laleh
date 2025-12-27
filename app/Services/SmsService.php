<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Random\RandomException;

class SmsService
{
    private const string SMS_API_KEY = 'bNu2hz275JFVxSWuK1DeF1ksFkUVHi5heDqe5aCBRfG3BC9MA7QtQAvIPrtPzkvc';
    private const string SMS_API_URL = 'https://api.sms.ir/v1/send/verify';
    private const int TEMPLATE_ID = 100000;

    /**
     * Send verification code to user's mobile number
     *
     * @param string $mobile
     * @return array
     * @throws RandomException
     */
    public static function sendVerificationCode(string $mobile): array
    {
        $code = random_int(1111, 9999);

        $response = Http::withHeaders([
            'ACCEPT' => 'application/json',
            'X-API-KEY' => self::SMS_API_KEY,
        ])->post(self::SMS_API_URL, [
            'mobile' => $mobile,
            'templateId' => self::TEMPLATE_ID,
            'parameters' => [
                ['name' => 'Code', 'value' => (string) $code],
            ],
        ]);

        return [
            'success' => $response['status'] === 1,
            'code' => $code,
            'response' => $response->json()
        ];
    }

    /**
     * Verify the code entered by user
     *
     * @param string $mobile
     * @param string $code
     * @param string $enteredCode
     * @return array
     */
    public static function verifyCode(string $mobile, string $code, string $enteredCode): array
    {
        if ((int) $enteredCode !== (int) $code) {
            return [
                'success' => false,
                'message' => 'کد اشتباه است'
            ];
        }

        $user = User::where('mobile', $mobile)->first();

        if ($user) {
            Auth::login($user, true);
            return [
                'success' => true,
                'user' => $user,
                'isNewUser' => false
            ];
        }

        return [
            'success' => true,
            'isNewUser' => true
        ];
    }


}
