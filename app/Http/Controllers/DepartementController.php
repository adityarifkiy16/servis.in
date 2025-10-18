<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:management_departement');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr['departments'] = Departement::orderBy('name', 'asc')->paginate(5);
        return view('department.index', $arr);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Departement::create($data);
        return redirect()->route('departments.index')->with('success', 'Departement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $department)
    {
        return view('department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departement $department)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $department->update($data);
        return redirect()->route('departments.index')->with('success', 'Departement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Departement deleted successfully.');
    }
}
