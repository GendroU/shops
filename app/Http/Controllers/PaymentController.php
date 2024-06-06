<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function pay(Request $request, Payment $pay)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $pay = new Payment([
            'user' => Auth::id(),
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'amount' => PaymentController::getTotalPrice2(),
        ]);

        $pay->save();

        return redirect()->route('dashboard')->with('success', 'Payment is being processed!');
    }

    
    static function getTotalPrice2()
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
