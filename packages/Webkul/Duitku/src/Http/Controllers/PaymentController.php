<?php

namespace Webkul\Duitku\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Webkul\Duitku\Payment\Duitku as DuitkuPayment;

class PaymentController extends Controller
{
    /**
     * Endpoint untuk membuat paymentUrl Duitku.
     */
    public function create(Request $request)
    {
        $payment = new DuitkuPayment();
        $result = $payment->createPaymentUrl();
        return response()->json([
            'success' => true,
            'data'    => $result,
        ]);
    }

    /**
     * Endpoint webhook untuk notifikasi dari Duitku.
     */
    public function webhook(Request $request)
    {
        $payload = $request->all();
        Log::info('Duitku webhook diterima', $payload);
        // TODO: Verifikasi signature dan update status order
        return response()->json(['status' => 'ok']);
    }
}
