<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceSale;
use Illuminate\Http\Request;

class ServiceSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceSales = ServiceSale::with('service')->orderBy('created_at', 'desc')->get();
        return view('service_sales.index', compact('serviceSales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('service_sales.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'service_date' => 'required|date',
        ]);

        $totalRevenue = $request->quantity * $request->price;
        ServiceSale::create([
            'service_id' => $request->service_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total_revenue' => $totalRevenue,
            'service_date' => $request->service_date,
        ]);

        return redirect()->route('service_sales.index')->with('success', 'Service sale recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $serviceSale = ServiceSale::with('service')->findOrFail($id);
        return view('service_sales.show', compact('serviceSale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $serviceSale = ServiceSale::findOrFail($id);
        $services = Service::all();
        return view('service_sales.edit', compact('serviceSale', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'service_date' => 'required|date',
        ]);

        $serviceSale = ServiceSale::findOrFail($id);
        $totalRevenue = $request->quantity * $request->price;

        $serviceSale->update([
            'service_id' => $request->service_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total_revenue' => $totalRevenue,
            'service_date' => $request->service_date,
        ]);

        return redirect()->route('service_sales.index')->with('success', 'Service sale updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serviceSale = ServiceSale::findOrFail($id);
        $serviceSale->delete();
        return redirect()->route('service_sales.index')->with('success', 'Service sale deleted successfully.');
    }
}
