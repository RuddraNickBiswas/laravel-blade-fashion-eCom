<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function index()
    {

       
        // $settings = config('settings');

        return view('admin.setting.index');
        // return Inertia::render('Setting/GeneralSettingIndex', [
        //     'settings' => $settings
        // ]);
    }


    public function generalSettingUpdate(Request $request)
    {

        $validatedData = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_currency' => 'required|string|max:3',
            'site_currency_symbol' => 'required|string|max:3',
            'site_currency_position' => ['required', Rule::in(['left', 'right'])],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate([
                'key' => $key,
            ], [
                'value' => $value,
            ]);
        }
        $settingService = app(SettingService::class);
        $settingService->clearCachedSettings();
            toastr()->success('setting updated successful');
        return redirect()->back();
    }
}
