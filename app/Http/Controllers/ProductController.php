<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Product;
use App\Models\Departement;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['jenis', 'departement'])->orderBy('name', 'asc')->paginate(5);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $arr['jenises'] = Jenis::orderBy('name', 'asc')->get();
        $arr['departements'] = Departement::orderBy('name', 'asc')->get();
        return view('product.create', $arr);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'jenis_id' => 'required|exists:jenis,id',
            'departement_id' => 'required|exists:departements,id',
        ]);
        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $arr['product'] = $product;
        $arr['jenises'] = Jenis::all();
        $arr['departements'] = Departement::all();
        return view('product.edit', $arr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'jenis_id' => 'required|exists:jenis,id',
            'departement_id' => 'required|exists:departements,id',
        ]);

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
