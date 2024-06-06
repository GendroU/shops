<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function itemAdd(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|string',
            'round_desc' => 'required|string',
            'caliber' => 'required|string',
            'mass' => 'required|string',
            'explosive_type' => 'required|string',
            'explosive_mass' => 'required|string',
            'tnt' => 'required|string',
            'fuze' => 'required|string',
            'pen' => 'required|string',
        ]);

        $item = new Item([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'round_desc' => $validatedData['round_desc'],
            'caliber' => $validatedData['caliber'],
            'mass' => $validatedData['mass'],
            'explosive_type' => $validatedData['explosive_type'],
            'explosive_mass' => $validatedData['explosive_mass'],
            'tnt' => $validatedData['tnt'],
            'fuze' => $validatedData['fuze'],
            'pen' => $validatedData['pen'],
        ]);

        $item->save();

        return redirect()->route('dashboard')->with('success', 'Item created successfully!');
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
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }
}
