<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentGatewaySetting;
use App\Services\PaymentGatewaySettingService;
use Illuminate\Http\Request;

class PaymentGatewaySettingController extends Controller
{
    public function index()
    {

        // $PaymentSetting = config('gatewaySettings');

        return view('admin.payment-setting.index');
    }

    public function paypalSettingUpdate(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'paypal_status' => 'required|boolean',
            'paypal_account_mode' => 'required|in:sandbox,live',
            'paypal_country_name' => 'required|string|max:4',
            'paypal_currency' => 'required|string|max:4',
            'paypal_currency_rate' => 'required|numeric',
            'paypal_client_id' => 'required|string',
            'paypal_secret_key' => 'required|string',
        ]);



        foreach ($validatedData as $key => $value) {
            PaymentGatewaySetting::updateOrCreate([
                'key' => $key,
            ], [
                'value' => $value,
            ]);
        }
        $PaymentGatewaySettingService = app(PaymentGatewaySettingService::class);
        $PaymentGatewaySettingService->clearCachedSettings();

        toastr()->success('PayPal setting Updated');
        return redirect()->back();
    }
    
}
