<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function itemDestroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('dashboard')->with('success', 'Cart item deleted successfully!');
    }

    public function itemEdit(Request $request, Cart $cart)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|string|max:255'
        ]);

        $newItems = explode("_", $cart->items);
        $newItems[0] = $validatedData['quantity'];

        $new = $newItems[0] . "_" . $newItems[1] . "_" . $newItems[2];

        $cart->update(['items' => $new]);

        return redirect()->route('dashboard')->with('success', 'Cart item edited successfully!');
    }

    public function itemAdd(Request $request, Item $item, Cart $cart)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|string|max:255'
        ]);

        $cart = new Cart([
            'user' => Auth::id(),
            'items' => $validatedData['quantity'] . "_" . $item->price . "_" . $item->id,
        ]);

        $cart->save();

        return redirect()->route('dashboard')->with('success', 'Item added to cart successfully!');
    }


    static function formatCartItem($cartItemString)
    {
        // Explode the string based on the delimiter (underscore)
        $parts = explode("_", $cartItemString);

        // Extract quantity, price, and item ID
        $quantity = $parts[0];
        $price = $parts[1];
        $price1 = preg_replace('/[^0-9.]/', '', $price);
        $price1 = (int) floatval($price);
        $itemId = $parts[2];
        $totalPrice = $quantity * $price1;

        // Find the corresponding item in the "items" table
        $item = Item::find($itemId);

        // Check if item exists
        if ($item) {
            $itemName = $item->name;
            return "({$quantity}) {$itemName} ({$price}) - TOTAL {$totalPrice}.00€";
        } else {
            // Handle case where item is not found (optional)
            return "Item not found (ID: {$itemId})";
        }
    }

    static function getQuantityOnly($cartItemString)
    {
        // Explode the string based on the delimiter (underscore)
        $parts = explode("_", $cartItemString);

        // Extract quantity, price, and item ID
        $quantity = $parts[0];
        return "{$quantity}";    
    }

    
    static function getTotalPrice()
    {
        $carts = Cart::where('user', '=', Auth::id())->get();

        $cartTotal = 0;

        foreach($carts as $cart) {
            $parts = explode("_", $cart->items);
            $price = $parts[1];
            $price1 = preg_replace('/[^0-9.]/', '', $price);
            $price1 = (int) floatval($price);

            $price1 = $price1 * $parts[0];

            $cartTotal = $cartTotal + $price1;
        }

        return $cartTotal;
    }
}
