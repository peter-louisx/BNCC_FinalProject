<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Termwind\Components\Raw;

class CartController extends Controller
{
    public function index()
    {
        $allProductsCart = Cart::where('user_id', auth()->user()->id)->get();
        $filteredProduct = [];
        $totalPrice = 0;
        $productChanged = [];
        foreach($allProductsCart as $product)
        {
            $getProduct = $product->product;

            if(!$getProduct){
                Cart::destroy($product->id);
                $productChanged[] = "A product has been deleted by admin";
                continue;
            }

            if($getProduct->product_quantity < $product->quantity || $getProduct->product_quantity == 0)
            {
                $product->quantity = $getProduct->product_quantity;

                if($getProduct->product_quantity == 0)
                {
                    Cart::destroy($product->id);
                    $productChanged[] = $getProduct->product_name . " is out of stock";
                    continue;
                }

                $productChanged[] = $getProduct->product_name . " stock has been changed";
                Cart::where('user_id', auth()->user()->id)->where('product_id', $product->product_id)->update(['quantity' => $product->product->product_quantity]);
                $totalPrice += $getProduct->product_price * $getProduct->product_quantity;
                $filteredProduct[] = $product;
                continue;
            }

            $totalPrice += $product->product->product_price * $product->quantity;
            $filteredProduct[] = $product;
        }

        return view('cart', ['carts' => $filteredProduct, 'totalPrice' => $totalPrice, 'productChanged' => $productChanged]);
    }

    public function store(Request $request)
    {
        
        $product = Product::find($request->product_id);

        if($product->product_quantity < 1)
        {
            return redirect('/')->with('error', 'Product is out of stock');
        }
        
        if(Cart::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->exists())
        {
            Cart::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->increment('quantity');
        }else{
            Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
                'quantity' => 1,
            ]);
        }

        return redirect('/')->with('success', 'Product has been added to cart successfully');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0',
        ]);

        if($request->quantity == 0)
        {
            Cart::destroy($cart->id);
            return redirect('/cart')->with('success', 'Product has been removed from cart successfully');
        }

        Cart::where('id', $cart->id)->update(['quantity' => $request->quantity]);
        return redirect('/cart')->with('success', 'Product quantity has been updated successfully');
    }

    public function destroy(Cart $cart)
    {
        Cart::destroy($cart->id);
        return redirect('/cart')->with('success', 'Product has been removed from cart successfully');
    }


    public function checkout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|min:10|max:100',
            'post_code' => 'required|min:5|max:5||doesnt_start_with:0',
        ],[
            'post_code.min' => 'Post code must be 5 digits',
            'post_code.max' => 'Post code must be 5 digits',
            'post_code.cannot_start_with' => 'Post code cannot start with 0',
        ]);

        $invoiceNumber = "";
        
        for($i = 0; $i < 10; $i++)
        {
            $invoiceNumber .= rand(0, 9);
        }
        
        $allProductsCart = Cart::where('user_id', auth()->user()->id)->get();

        foreach($allProductsCart as $product)
        {
            if($product->product == null) continue;

            $product->product->update([
                'product_quantity' => $product->product->product_quantity - $product->quantity,
            ]);
        }

        Cart::where('user_id', auth()->user()->id)->delete();

        Invoice::create([
            'invoice_number' => $invoiceNumber,
            'post_code' => $request->post_code,
            'address' => $request->address,
        ]);

        return redirect('/')->with('success', 'You have successfully checked out');
    }

}