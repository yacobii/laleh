<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class DargahController extends Controller
{
    public function parsian(Order $order)
    {
        $PIN = '6JKG32315700rWx8RM6g';
        $url = "https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx?wsdl";
        $callback = route('parsian.success', $order); // Updated callback URL

        $params = [
            "LoginAccount" => $PIN,
            "Amount" => $order->original_total() * 10,
            "OrderId" => $order->id,
            "CallBackUrl" => $callback,
            "Originator" => substr($order->user->mobile, 1)
        ];

        $client = new \SoapClient($url);
        try {
            $result = $client->SalePaymentRequest(["requestData" => $params]);

            if ($result->SalePaymentRequestResult->Token && $result->SalePaymentRequestResult->Status === 0) {
                $token = $result->SalePaymentRequestResult->Token;

                $order->dargah()->create([
                    'order_id' => $order->id,
                    'token' => $token,
                ]);

                return redirect()->away("https://pec.shaparak.ir/NewIPG/?Token=" . $token);
            } else {
                return back()->withErrors("خطا در پرداخت: " . $result->SalePaymentRequestResult->Message);
            }
        } catch (Exception $ex) {
            return back()->withErrors("خطای سرور: " . $ex->getMessage());
        }
    }

    public function success(Request $request, Order $order)
    {
        // Parsian payment gateway response
        $status = $request->input('status');
        $token = $request->input('token');
        $order_id = $request->input('orderId');

        if ($status == 0) {
            // Mark order as paid
            $order->update(['status' => 'paid']);

            return redirect()->route('parsian.show',$order);
        } else {
            return redirect()->route('parsian.show',$order)
                ->withErrors('پرداخت ناموفق بود. لطفا دوباره تلاش کنید.');
        }
    }

    public function show(Order $order)
    {
        return view('dargah.success', compact('order'));
    }
}
