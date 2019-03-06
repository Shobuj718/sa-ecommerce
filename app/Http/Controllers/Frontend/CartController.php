<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller
{
    public function showCart()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        $cart['total'] = array_sum(array_column($cart, 'total_price'));
        //dd($cart);
        return view('frontend.cart', compact('cart'));        
    }

    public function addToCart(Request $request)
    {

    	try {

    		$this->validate($request, [
    				'product_id' => 'required|numeric',
    			]);
    		
    	} catch (Exception $e) {
    		return redirect()->back();
    	}

    	$product = Product::findOrFail($request->input('product_id'));
        $unit_price = ($product->sale_price != null && $product->sale_price > 0) ? $product->sale_price : $product->price;

        $cart = session()->has('cart') ? session()->get('cart') : [];

    	if(array_key_exists($product->id, $cart)){
            $cart[$product->id]['quantity']++;
            $cart[$product->id]['total_price'] = $cart[$product->id]['quantity'] * $cart[$product->id]['unit_price'];
        }
        else{
            $cart[$product->id] = [
                'title' => $product->title,
                'quantity' => 1,
                'unit_price' => $unit_price,
                'total_price' => $unit_price,
            ];
        }

        session(['cart' => $cart]);   
        session()->flash('message', $product->title.' added to cart');
        
    	return redirect()->route('cart.show');

    }

    public function removeFromCart(Request $request)
    {
        try {
            $this->validate($request, [
                    'product_id' => 'required|numeric',
                ]);
        } catch (Exception $e) {
            return redirect()->back();
        }

        $cart = session()->has('cart') ? session()->get('cart') : [];

        unset($cart[$request->input('product_id')]);

        session(['cart' => $cart]);

        session()->flash('message', 'Product remove from your cart');

        return redirect()->back();

    }

    public function clearCart()
    {
        session(['cart' => []]);
        return redirect()->back();
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }
}
