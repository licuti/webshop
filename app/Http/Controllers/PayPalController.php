<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Session;

session_start();
class PayPalController extends Controller
{
    /**
     * create transaction.
     *
     * return \Illuminate\Http\Response
     */
        public function createTransaction()
        {
            return view('pages.paypal');
        }

        /**
         * process transaction.
         *
         * @return \Illuminate\Http\Response
         */
        public function processTransaction(Request $request)
        {

            $total_usd = round(Session::get('carttotal')/24849,2); // lam tron 2 chu so

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('successTransaction'),
                    "cancel_url" => route('cancelTransaction'),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $total_usd
                        ]
                    ]
                ]
            ]);

            if (isset($response['id']) && $response['id'] != null) {

                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }

                return redirect()
                    ->route('showcheckout')
                    ->with('error', 'Something went wrong.');

            } else {
                return redirect()
                    ->route('showcheckout')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }

        /**
         * success transaction.
         *
         * @return \Illuminate\Http\Response
         */
        public function successTransaction(Request $request)
        {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                return redirect()
                    ->route('showcheckout')
                    ->with('success', 'Đã thanh toán bằng PayPal thành công. Mời bạn xác nhận đơn hàng !');
            } else {
                return redirect()
                    ->route('createTransaction')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }

        /**
         * cancel transaction.
         *
         * @return \Illuminate\Http\Response
         */
        public function cancelTransaction(Request $request)
        {
            return redirect()
                ->route('showcheckout')
                ->with('error', $response['message'] ?? 'You have canceled the transaction.');
        }

}
