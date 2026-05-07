<?php
namespace App\Http\Controllers;
use App\Models\ShoeProduct;
use Illuminate\Http\Request;

class ShoeProductController extends Controller
{
    // Show all shoes
    public function index()
    {
        $shoes = ShoeProduct::all();
        return view('shoes.index', compact('shoes'));
    }

    // Show the Add Shoe form
    public function create()
    {
        return view('shoes.create');
    }

    // Save new shoe to database
    public function store(Request $request)
    {
        $request->validate([
            'product_name'  => 'required',
            'brand'    => 'required',
            'category' => 'required',
            'size'     => 'required',
            'color'    => 'required',
            'stock_quantity'  =>'required|numeric',
            'price'    => 'required|numeric',
        ]);

        ShoeProduct::create($request->all());
        return redirect()->route('shoes.index')->with('success', 'Shoe added!');
    }

    // Show the Edit form
    public function edit(ShoeProduct $shoe)
    {
        return view('shoes.edit', compact('shoe'));
    }

    // Update the shoe in the database
    public function update(Request $request, ShoeProduct $shoe)
    {
        $shoe->update($request->all());
        return redirect()->route('shoes.index')->with('success', 'Shoe updated!');
    }

    // Delete a shoe
    public function destroy(ShoeProduct $shoe)
    {
        $shoe->delete();
        return redirect()->route('shoes.index')->with('success', 'Shoe deleted!');
    }
}