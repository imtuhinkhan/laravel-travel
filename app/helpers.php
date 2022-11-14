<?php
use App\Models\CurrencySetting;
if(!function_exists('convert_currency')){
    function convert_currency($val){
        $currency = CurrencySetting::first();
        $convertedCurrency = $val;
        if(Session::has('currency')){
            $selectedCurrency = Session::get('currency');
            if($selectedCurrency=='USD'){
                $convertedCurrency = ($val/100)*$currency->dollar;
            }elseif($selectedCurrency=='RUR'){
                $convertedCurrency = ($val/100)*$currency->rubble;

            }elseif($selectedCurrency=='EURO'){
                $convertedCurrency = ($val/100)*$currency->euro;

            }else{
                $convertedCurrency = $val;
            }
        }
        return $convertedCurrency;
    }
}

if(!function_exists('currency_word')){
    function currency_word(){
        $word = 'AMD';

        if(Session::has('currency')){
            $selectedCurrency = Session::get('currency');
            if($selectedCurrency=='USD'){
                $word = 'USD';
            }elseif($selectedCurrency=='RUR'){
                $word = 'RUB';

            }elseif($selectedCurrency=='EURO'){
                $word = 'EURO';

            }else{
                $word = 'AMD';
            }
        }
        return $word;
    }
}

if(!function_exists('currency_icon')){
    function currency_icon(){
        $word = 'fa-money';
        if(Session::has('currency')){
            $selectedCurrency = Session::get('currency');
            if($selectedCurrency=='USD'){
                $word = 'fa-dollar-sign';
            }elseif($selectedCurrency=='RUR'){
                $word = 'fa-rub';

            }elseif($selectedCurrency=='EURO'){
                $word = 'fa-euro-sign';

            }else{
                $word = 'fa-money';
            }
        }
        return $word;
    }
}