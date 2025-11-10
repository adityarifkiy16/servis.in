<?php

namespace App\Http\Controllers;

use Svg\Tag\Rect;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnitController extends Controller
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
        $query = Unit::select('id', 'name');
        $query->when(isset($request->search), function ($q) use ($request) {
            $q->where('name', 'LIKE', '%' . $request->search . '%');
        });

        $arr['units'] = $query->paginate(5);
        return view('unit.index', $arr);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:10',
                Rule::unique('units', 'name')->whereNull('deleted_at'),
            ],
        ]);

        Unit::create([
            'name' => $request->name
        ]);

        return redirect()->route('unit.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        $arr['unit'] = $unit;
        return view('unit.edit', $arr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => 'required|string|max:10',
        ]);
        $unit->update(['name' => $request->name]);
        return redirect()->route('unit.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        if (count($unit->products) > 0) {
            return redirect()->route('unit.index')->with('error', 'Cannot delete unit because it is associated with products.');
        }
        $unit->delete();
        return redirect()->route('unit.index')->with('success', 'Unit deleted successfully.');
    }

    public function getunit(Request $request)
    {
        $unit = Unit::whereHas('jenis', function ($query) use ($request) {
            $query->where('id', $request->jenis_id);
        })->first();
        return response()->json($unit);
    }
}
