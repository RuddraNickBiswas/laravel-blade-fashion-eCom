<?php

if (!function_exists('currencyPosition')) {
    function currencyPosition($price)
    {
        if (config('settings.site_currency_position') === 'right') {

            return  $price . config('settings.site_currency_symbol');

        } else if (config('settings.site_currency_position') === 'left') {

            return  config('settings.site_currency_symbol') . $price;

        }
    }
}


if (!function_exists('cartTotal')) {

    /**
     * this is for now if feature if i add size depended price or color varient price it will help 
     */

    function cartTotal()
    {
        $total = 0;


        foreach (Cart::content() as $key => $item) {
            $productPrice = $item->price;
            $qty = $item->qty;

            $total += $productPrice * $qty;
        }

        return $total;
    }
}

if (!function_exists('cartProductTotal')) {
    function cartProductTotal($rowId)
    {
        $cartProduct = Cart::get($rowId);
        $price = $cartProduct->price;
        $qty = $cartProduct->qty;

        $total = $price * $qty;

        return $total;
    }
}
