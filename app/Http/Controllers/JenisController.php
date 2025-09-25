<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
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
        return view('jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Jenis::create($data);
        return redirect()->route('jenis.index')->with('success', 'Jenis created successfully.');
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
        return view('jenis.edit', compact('jenise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jenis $jenise)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $jenise->update($data);
        return redirect()->route('jenises.index')->with('success', 'Jenis updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jenise)
    {
        $jenise->delete();
        return redirect()->route('jenises.index')->with('success', 'Jenis deleted successfully.');
    }
}
