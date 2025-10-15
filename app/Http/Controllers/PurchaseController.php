<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::with('item')->orderBy('created_at', 'desc')->get();
        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        return view('purchases.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'buy_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        $totalCost = $request->quantity * $request->buy_price;
        Purchase::create([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'buy_price' => $request->buy_price,
            'total_cost' => $totalCost,
            'purchase_date' => $request->purchase_date,
        ]);

        // Update item stock
        $item = Item::find($request->item_id);
        $item->increment('stock', $request->quantity);

        return redirect()->route('purchases.index')->with('success', 'Purchase recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase = Purchase::with('item')->findOrFail($id);
        return view('purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $items = Item::all();
        return view('purchases.edit', compact('purchase', 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'buy_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        $purchase = Purchase::findOrFail($id);
        $oldQuantity = $purchase->quantity;
        $totalCost = $request->quantity * $request->buy_price;

        $purchase->update([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'buy_price' => $request->buy_price,
            'total_cost' => $totalCost,
            'purchase_date' => $request->purchase_date,
        ]);

        // Update item stock
        $item = Item::find($request->item_id);
        $item->increment('stock', $request->quantity - $oldQuantity);

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $item = $purchase->item;
        $item->decrement('stock', $purchase->quantity);
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }
}
