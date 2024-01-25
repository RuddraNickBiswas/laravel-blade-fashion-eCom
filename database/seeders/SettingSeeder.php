<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            $settings = [
                'site_name' => 'fashion eCom',
                'site_currency' => 'USD',
                'site_currency_symbol' => '$',
                'site_currency_position' => 'left',
                
            ];

            foreach ($settings as $key => $value) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }
    }
}
