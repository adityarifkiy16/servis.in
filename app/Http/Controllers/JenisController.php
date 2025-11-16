<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:management_product');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr['jenises'] = Jenis::paginate(5);
        return view('jenis.index', $arr);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $arr['units'] = Unit::all();
        return view('jenis.create', $arr);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit_id' => 'nullable|exists:units,id',
        ]);
        Jenis::create($data);
        return redirect()->route('jenises.index')->with('success', 'Jenis created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenis $jenise)
    {
        $arr['jenise'] = $jenise;
        $arr['units'] = Unit::all();
        return view('jenis.edit', $arr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jenis $jenise)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit_id' => 'required|exists:units,id',
        ]);
        $jenise->update($data);
        return redirect()->route('jenises.index')->with('success', 'Jenis updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jenise)
    {
        if ($jenise->products()->exists()) {
            return redirect()->route('jenises.index')->with('error', 'Cannot delete jenis with associated products.');
        }

        if ($jenise->servicetypes()->exists()) {
            return redirect()->route('jenises.index')->with('error', 'Cannot delete jenis with associated service types.');
        }
        $jenise->delete();
        return redirect()->route('jenises.index')->with('success', 'Jenis deleted successfully.');
    }
}
