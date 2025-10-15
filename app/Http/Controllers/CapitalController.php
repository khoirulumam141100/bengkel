<?php

namespace App\Http\Controllers;

use App\Models\Capital;
use Illuminate\Http\Request;

class CapitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $capitals = Capital::orderBy('created_at', 'desc')->get();
        return view('capitals.index', compact('capitals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('capitals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'initial_capital' => 'required|numeric|min:0',
            'start_date' => 'required|date',
        ]);

        Capital::create($request->all());
        return redirect()->route('capitals.index')->with('success', 'Capital set successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $capital = Capital::findOrFail($id);
        return view('capitals.show', compact('capital'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $capital = Capital::findOrFail($id);
        return view('capitals.edit', compact('capital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'initial_capital' => 'required|numeric|min:0',
            'start_date' => 'required|date',
        ]);

        $capital = Capital::findOrFail($id);
        $capital->update($request->all());
        return redirect()->route('capitals.index')->with('success', 'Capital updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $capital = Capital::findOrFail($id);
        $capital->delete();
        return redirect()->route('capitals.index')->with('success', 'Capital deleted successfully.');
    }
}
