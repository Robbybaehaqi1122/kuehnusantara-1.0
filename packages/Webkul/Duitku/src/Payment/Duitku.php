<?php

namespace Webkul\Duitku\Payment;

use Illuminate\Support\Facades\Log;
use Webkul\Payment\Payment\Payment;

class Duitku extends Payment
{
    protected $code = 'duitku_gateway';

    public function getRedirectUrl()
    {
        return route('duitku.gateway.create');
    }

    /**
     * Membuat request pembayaran ke Duitku dan mengembalikan paymentUrl.
     * Implementasi lengkap perlu menyesuaikan dengan API Duitku.
     *
     * @return array
     */
    public function createPaymentUrl(): array
    {
        // TODO: Implementasikan request ke API Duitku di sini
        // Gunakan env('DUITKU_MERCHANT_CODE'), env('DUITKU_API_KEY')
        // dan data cart/order
        Log::info('Duitku::createPaymentUrl dipanggil - implementasikan request ke API Duitku');
        return [
            'paymentUrl' => null,
            'error' => 'Belum diimplementasikan',
        ];
    }
}
