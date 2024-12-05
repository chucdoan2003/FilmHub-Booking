<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function index()
    {
        $drinks = Drink::all();
        return view('admin.combos.drinks.index', compact('drinks'));
    }

    public function create()
    {
        return view('admin.combos.drinks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Drink::create($request->all());
        return redirect()->route('admin.drinks.index')->with('success', 'Drink created successfully.');
    }

    public function show($id)
    {
        $drink = Drink::findOrFail($id);
        return view('admin.combos.drinks.show', compact('drink'));
    }

    public function edit($id)
    {
        $drink = Drink::findOrFail($id);
        return view('admin.combos.drinks.edit', compact('drink'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $drink = Drink::findOrFail($id);
        $drink->update($request->all());
        return redirect()->route('admin.drinks.index')->with('success', 'Drink updated successfully.');
    }

    public function destroy($id)
    {
        $drink = Drink::findOrFail($id);
        $drink->delete();
        return redirect()->route('admin.drinks.index')->with('success', 'Drink deleted successfully.');
    }
}
