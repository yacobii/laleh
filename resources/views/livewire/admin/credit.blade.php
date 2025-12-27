<?php

use  Livewire\Volt\Component;
use Illuminate\Support\Facades\Http;


new class extends Component {

    #[\Livewire\Attributes\Computed]
    public function credit()
    {
        try {
            $response = Http::withHeaders([
                'ACCEPT' => 'Application/json',
                'X-API-KEY' => 'bNu2hz275JFVxSWuK1DeF1ksFkUVHi5heDqe5aCBRfG3BC9MA7QtQAvIPrtPzkvc',
            ])->get('https://api.sms.ir/v1/credit');

            // You can check HTTP response code or decoded json
            if ($response->successful() && ($response->json()['status'] ?? null) == 1) {
                return $response->json();
            } else {
                return null;
            }

        } catch (\Exception $e) {
            \Log::error('SMS credit check failed: ' . $e->getMessage());
            return null;
        }
    }


}

?>

<div class="flex flex-col md:flex-row items-center justify-center gap-x-2 text-sm">
    @if($this->credit != null)
        <p>پیامک</p>
        <p>{{ number_format($this->credit['data']) }}</p>

    @else
        <p>خطا در sms</p>
    @endif


</div>
