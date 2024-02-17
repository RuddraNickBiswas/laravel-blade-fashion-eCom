<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderPaymentUpdateEvent;
use App\Events\OrderPlacedNotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentGatewaySetting;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Stripe\Checkout\Session as StripeCheckoutSession;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index(Order $order){

        return view('frontend.product.payment.index' , compact('order'));
    }

    public function paymentSuccess()
    {
        
        return view('frontend.product.payment.payment-success');
    }

    public function paymentCancel()
    {
       
        return view('frontend.product.payment.payment-cancel');
    }

    //  PayPal Payment

    public function setPaypalConfig()
    {
        $config = [
            'mode'    => config('gatewaySettings.paypal_account_mode'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'         => config('gatewaySettings.paypal_client_id'),
                'client_secret'     => config('gatewaySettings.paypal_secret_key'),
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => config('gatewaySettings.paypal_client_id'),
                'client_secret'     => config('gatewaySettings.paypal_secret_key'),
                'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
            ],

            'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => config('gatewaySettings.paypal_currency'),
            'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
            'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
        ];


        return $config;
    }

    public function payWithPaypal(Order $order)
    {

        // dd($order);

        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);

        $provider->getAccessToken();

        $response = $provider->createOrder([
            'intent' => "CAPTURE",
            'application_context' => [
                'return_url' => route('paypal.success',$order->id),
                'cancel_url' => route('paypal.cancel'),

            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('gatewaySettings.paypal_currency'), //tba from model, 
                        'value' => $order->grand_total,
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] !== null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->to($link['href']);
                }
            }
        } else {
            $error = $response['error']['message'];
            return redirect()->route('payment.cancel')->with('error', $error);
        }
    }
    public function paypalSuccess(Request $request, Order $order)
    {
        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);

        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        $orderId = $order->id;
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            $capture = $response["purchase_units"][0]['payments']['captures'][0];

          
            $paymentInfo = [
                'transaction_id' => $capture['id'],
                'currency' => $capture['amount']['currency_code'],
                'status' => strtolower($capture['status']) === 'completed' ? 'complete' : strtolower($capture['status']),
            ];

            OrderPaymentUpdateEvent::dispatch($orderId, $paymentInfo, 'paypal');
            OrderPlacedNotificationEvent::dispatch($orderId);
            toastr()->success('order paid successful');
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('payment.cancel');
            $error = $response['error']['message'];

            // $this->transactionFailedUpdateStatue($paymentId, 'paypal');

            return redirect()->route('payment.cancel')->with('error', $error);
        }

        return redirect()->route('payment.cancel')->with('error', 'payment cancel');
    }
    public function paypalCancel(Order $order)
    {

        $this->transactionFailedUpdateStatue($order->id, 'paypal');
        return 'payment cancel';
    }
    // end paypal

      /** Stripe */
      public function setStripeConfig()
      {
      }
  
      public function payWithStripe(Order $order)
      {
          $grandTotal = $order->grand_total;
  
          $calculatedTotal = ($grandTotal * config('gatewaySettings.stripe_currency_rate')) * 100;
  
          Stripe::setApiKey(config('gatewaySettings.stripe_secret_key'));
  
          $response = StripeCheckoutSession::create([
              'line_items' => [
                  [
                      'price_data' => [
                          'currency' => config('gatewaySettings.stripe_currency'),
                          'product_data' => [
                              'name' => 'Course / Books',
                          ],
                          'unit_amount' => $calculatedTotal,
                      ],
                      'quantity' => 1
                  ]
              ],
              'mode' => 'payment',
              'success_url' => route('stripe.success', $order->id) . '?session_id={CHECKOUT_SESSION_ID}',
              'cancel_url' => route('stripe.cancel'),
          ]);
        //   return Inertia::location($response->url);
          return redirect()->to($response->url);
      }
  
  
      public function stripeSuccess(Request $request, Order $order)
      {
  
          $sessionId = $request->session_id;
          Stripe::setApiKey(config('gatewaySettings.stripe_secret_key'));
  
  
          $response = StripeCheckoutSession::retrieve($sessionId);
  
          $orderId = $order->id;
          if ($response->payment_status === 'paid') {
              $paymentInfo = [
                  'transaction_id' => $response->payment_intent,
                  'currency' => $response->currency,
                  'status' => strtolower($response->status),
              ];
  
              OrderPaymentUpdateEvent::dispatch($orderId, $paymentInfo, 'stripe');
              OrderPlacedNotificationEvent::dispatch($orderId);
              return redirect()->route('payment.success')->with('success', 'payment successfull');
          } else {
  
              $this->transactionFailedUpdateStatue($orderId, 'stripe');
  
              return redirect()->route('payment.cancel')->with('error', 'stripe paymend failed');
          }
  
  
          return 'stripe success';
      }
  
      public function stripeCancel(Request $request, Order $order)
      {
  
          $this->transactionFailedUpdateStatue($order->id, 'stripe');
          return 'stripe cancel';
      }



    public function transactionFailedUpdateStatue($paymentId, $method)
    {
        $paymentInfo = [
            'transaction_id' => "",
            'currency' => "",
            'status' => 'failed',
        ];

        OrderPaymentUpdateEvent::dispatch($paymentId, $paymentInfo, $method);
    }
}
