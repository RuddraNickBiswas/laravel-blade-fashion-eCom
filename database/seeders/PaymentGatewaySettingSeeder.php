<?php

namespace Database\Seeders;

use App\Models\PaymentGatewaySetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'paypal_status' => true,
            'paypal_account_mode' => 'sandbox',
            'paypal_country_name' => 'US',
            'paypal_currency' => 'USD',
            'paypal_currency_rate' => 1.0,
            'paypal_client_id' => 'AW6vKMH2SgxCuC9FZgknjdUamK7c9qHV0q6k_iCuzSO17wOyQp2CKs5Dk6TkqNcYaSvgZYlzjD2L3Dk2',
            'paypal_secret_key' => 'EBDnQAPf--TAfNIbL1Otwy3o70WBaaVq3676EBxpnRJFmzQrwDnZu7XrdvnLQ34L2RA_kzid2_V2GBRa',

            /** stripe setting */
            'stripe_status' => true,
            'stripe_country_name' =>'US',
            'stripe_currency' =>'USD',
            'stripe_currency_rate' => '1',
            'stripe_api_key' => 'pk_test_51OkmOSCYmqPS9sWMaQh7pMttsXIbA29xpDDOObFUkTnVhPDGq4YNxLPO5FLyOWAaoeAlQIzyqjwcHdYypj9sXrnk00z7Cz6kod',
            'stripe_secret_key' => 'sk_test_51OkmOSCYmqPS9sWM56k5eq8tWuJqwU9RlvIgvsrTsDjrrKBSsqHCgQhJ68CzvYMjTxoVCs4tRTy4b9QPyohXlGPG00E7P2jcJZ',
           
        ];

        foreach ($settings as $key => $value) {
            PaymentGatewaySetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
    
}
