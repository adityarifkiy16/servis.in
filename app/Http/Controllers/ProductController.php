<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Product;
use App\Models\Service;
use App\Models\Departement;
use App\Models\ProductUsageLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:management_product');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['jenis', 'departement']);
        $query->when(isset($request->search), function ($q) use ($request) {
            $q->where('name', 'LIKE', '%' . $request->search . '%');
        });
        $arr['products'] = $query->orderBy('name', 'asc')->paginate(5);
        return view('product.index', $arr);
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
            'usage' => 'nullable|integer|min:0',
            'unit_id' => 'nullable|exists:units,id',
            'serial_number' => ['required', 'string', 'max:255', Rule::unique('products', 'serial_number')->whereNull('deleted_at')],
        ]);
        $product = Product::create($data);
        ProductUsageLog::create([
            'product_id' => $product->id,
            'old_usage' => $product->usage,
            'new_usage' => $product->usage,
            'user_id' => auth()->user()->id
        ]);

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
            'serial_number' => ['required', 'string', 'max:255', Rule::unique('products', 'serial_number')->ignore($product->id)->whereNull('deleted_at')],
            'jenis_id' => 'required|exists:jenis,id',
            'departement_id' => 'required|exists:departements,id',
            'unit_id' => 'nullable|exists:units,id',
        ]);

        // Update dulu produk
        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function editUsage()
    {
        $arr['products'] = Product::with(['jenis'])->pluck('usage', 'id')->toArray();
        return view('product.usage', $arr);
    }

    public function updateUsage(Request $request)
    {
        foreach ($request->usage as $id => $usage) {
            $product = Product::find($id);
            if ($product) {
                $oldUsage = $product->usage ?? 0;
                $product->update(['usage' => $usage]);

                ProductUsageLog::create([
                    'product_id' => $product->id,
                    'old_usage' => $oldUsage,
                    'new_usage' => $usage,
                    'user_id' => auth()->user()->id
                ]);

                $selisih = $usage - $oldUsage;
                if ($selisih > 0) {
                    $servicetypes = $product->jenis->servicetypes;
                    foreach ($servicetypes as $st) {
                        if ($selisih >= $st->interval_usage) {
                            Service::create([
                                'product_id'      => $product->id,
                                'service_type_id' => $st->id,
                                'status'          => 0,
                                'description'     => "Auto-generated service (selisih $selisih {$product->usage_unit})",
                                'date'            => now(),
                            ]);
                        }
                    }
                }
            }
        }
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->services()->exists()) {
            return redirect()->route('products.index')->with('error', 'Cannot delete product with associated services.');
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
