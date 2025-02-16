<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;

class AddOrRemoveProductController extends Controller
{
    public function __invoke(int $productID)
    {
        if (Cart::where('product_id', $productID)->exists()) {
            Cart::where('product_id', $productID)->delete();
        } else {
            Cart::create(['product_id' => $productID]);
        }

        return redirect()->back();
    }
}
