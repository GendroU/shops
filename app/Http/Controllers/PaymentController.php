<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

use Illuminate\Http\RedirectResponse;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

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

        $cartItems = array();
        $cart = Cart::where('user', '=', Auth::id())->get();
        foreach ($cart as $cart1) {
            $cart1 = explode("_", $cart1->items);
            array_push($cartItems, $cart1);
        }

        $id_1_quantity = 0;
        $id_2_quantity = 0;
        $id_3_quantity = 0;
        $id_4_quantity = 0;
        $id_5_quantity = 0;
        $id_6_quantity = 0;
        $id_7_quantity = 0;
        $id_8_quantity = 0;
        $id_9_quantity = 0;

        
        foreach($cartItems as $cartItem) {
            if($cartItem[2] == 1) {
                $id_1_quantity = $id_1_quantity + $cartItem[0];
            }
            if($cartItem[2] == 2) {
                $id_2_quantity = $id_2_quantity + $cartItem[0];
            }
            if($cartItem[2] == 3) {
                $id_3_quantity = $id_3_quantity + $cartItem[0];
            }
            if($cartItem[2] == 4) {
                $id_4_quantity = $id_4_quantity + $cartItem[0];
            }
            if($cartItem[2] == 5) {
                $id_5_quantity = $id_5_quantity + $cartItem[0];
            }
            if($cartItem[2] == 6) {
                $id_6_quantity = $id_6_quantity + $cartItem[0];
            }
            if($cartItem[2] == 7) {
                $id_7_quantity = $id_7_quantity + $cartItem[0];
            }
            if($cartItem[2] == 8) {
                $id_8_quantity = $id_8_quantity + $cartItem[0];
            }
            if($cartItem[2] == 9) {
                $id_9_quantity = $id_9_quantity + $cartItem[0];
            }
        }

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $products = [
            [
                'name' => 'BR-471',
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => 15000,
                    'product_data' => [
                        'name' => 'Soviet APHE round mostly used in the IS-3 heavy tank.',
                    ],
                ],
                'quantity' => $id_1_quantity,
            ],
            [
                'name' => '3BK12M',
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => 80000,
                    'product_data' => [
                        'name' => 'Soviet HEATFS round mostly used in the T-72 main battle tank.',
                    ],
                ],
                'quantity' => $id_2_quantity,
            ],
            [
                'name' => 'PG-9',
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => 35000,
                    'product_data' => [
                        'name' => 'Soviet HEAT grenade mostly used in the BMP-1 infantry fighting vehicle.',
                    ],
                ],
                'quantity' => $id_3_quantity,
            ],
            [
                'name' => '9M113',
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => 140000,
                    'product_data' => [
                        'name' => 'Soviet ATGM mostly used in the BMP-1 infantry fighting vehicle.',
                    ],
                ],
                'quantity' => $id_4_quantity,
            ],
            [
                'name' => '9M37M',
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => 300000,
                    'product_data' => [
                        'name' => 'Soviet SAM mostly used in the Strela-10 surface-to-air missile system.',
                    ],
                ],
                'quantity' => $id_5_quantity,
            ],
            [
                'name' => 'S-5K',
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => 80000,
                    'product_data' => [
                        'name' => 'Soviet rocket mostly used in helicopters.',
                    ],
                ],
                'quantity' => $id_6_quantity,
            ],
            [
                'name' => '9M17M',
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => 150000,
                    'product_data' => [
                        'name' => 'Soviet ATGM mostly used in helicopters.',
                    ],
                ],
                'quantity' => $id_7_quantity,
            ],
            [
                'name' => 'M344A1',
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => 70000,
                    'product_data' => [
                        'name' => 'American HEAT grenade mostly used in the M50.',
                    ],
                ],
                'quantity' => $id_8_quantity,
            ],
            [
                'name' => 'M829A2',
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => 1500000,
                    'product_data' => [
                        'name' => 'American APFSDS round mostly used in the Abrams tank.',
                    ],
                ],
                'quantity' => $id_9_quantity,
            ],
        ];

        $lineItems = [];
        foreach ($products as $product) {
            if($product['quantity'] > 1) {
                $lineItems[] = [
                    'price_data' => $product['price_data'],
                    'quantity' => $product['quantity'],
                ];
            }
        }

        $session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('success'),
        ]);

        return redirect()->away($session->url);
    }


    static function getTotalPrice2()
    {
        $carts = Cart::where('user', '=', Auth::id())->get();

        $cartTotal = 0;

        foreach ($carts as $cart) {
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
