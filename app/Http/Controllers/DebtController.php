<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $debts = Debt::orderBy('created_at', 'desc')->get();
        return view('debts.index', compact('debts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('debts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'debtor_name' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'debt_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:debt_date',
            'status' => 'required|in:belum_lunas,lunas',
        ]);

        Debt::create($request->all());

        return redirect()->route('debts.index')->with('success', 'Hutang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Debt $debt)
    {
        return view('debts.show', compact('debt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debt $debt)
    {
        return view('debts.edit', compact('debt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Debt $debt)
    {
        $request->validate([
            'debtor_name' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'debt_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:debt_date',
            'status' => 'required|in:belum_lunas,lunas',
        ]);

        $debt->update($request->all());

        return redirect()->route('debts.index')->with('success', 'Hutang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Debt $debt)
    {
        $debt->delete();

        return redirect()->route('debts.index')->with('success', 'Hutang berhasil dihapus.');
    }
}
