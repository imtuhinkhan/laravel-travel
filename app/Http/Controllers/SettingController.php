<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CurrencySetting;

class SettingController extends Controller
{
    public function currencyIndex(){
        $currency = CurrencySetting::first();
        return view('Backend.Admin.Settings.currency',  compact('currency'));

    }

    public function currencyStore(Request $request){
        $currency = CurrencySetting::first();
        if(!$currency){
            $currency = new CurrencySetting();
        }
        $currency->amd = 100;
        $currency->dollar = $request->usd;
        $currency->rubble = $request->rubble;
        $currency->euro = $request->euro;
        $currency->save();
        return redirect()->back()->with("msg", "Saved successfully!")
     ->with("success", true);
    }
}
