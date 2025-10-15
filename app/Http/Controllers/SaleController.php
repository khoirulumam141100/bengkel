<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('item')->orderBy('created_at', 'desc')->get();
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::where('stock', '>', 0)->get();
        return view('sales.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'sell_price' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ]);

        $item = Item::find($request->item_id);
        if ($item->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient stock.']);
        }

        $totalRevenue = $request->quantity * $request->sell_price;
        Sale::create([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'sell_price' => $request->sell_price,
            'total_revenue' => $totalRevenue,
            'sale_date' => $request->sale_date,
        ]);

        // Update item stock
        $item->decrement('stock', $request->quantity);

        return redirect()->route('sales.index')->with('success', 'Sale recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = Sale::with('item')->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sale = Sale::findOrFail($id);
        $items = Item::all();
        return view('sales.edit', compact('sale', 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'sell_price' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ]);

        $sale = Sale::findOrFail($id);
        $oldQuantity = $sale->quantity;
        $totalRevenue = $request->quantity * $request->sell_price;

        $item = Item::find($request->item_id);
        if ($item->stock + $oldQuantity < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient stock.']);
        }

        $sale->update([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'sell_price' => $request->sell_price,
            'total_revenue' => $totalRevenue,
            'sale_date' => $request->sale_date,
        ]);

        // Update item stock
        $item->increment('stock', $oldQuantity);
        $item->decrement('stock', $request->quantity);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sale = Sale::findOrFail($id);
        $item = $sale->item;
        $item->increment('stock', $sale->quantity);
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}
