<?php

if(!function_exists('cartTotal')){
    function cartTotal(){
        $total = 0;
        
        
        foreach ( Cart::content() as $key => $item) {
            $productPrice = $item->price;
            $qty = $item->qty;

            $total += $productPrice * $qty;
        }

        return $total;

    }
}