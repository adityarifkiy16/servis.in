<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr['serviceTypes'] = ServiceType::with(['jenis'])->orderBy('name', 'asc')->paginate(5);
        return view('service_type.index', $arr);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $arr['jenises'] = \App\Models\Jenis::orderBy('name', 'asc')->get();
        return view('service_type.create', $arr);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'jenis_id' => 'required|exists:jenis,id',
            'interval_month' => 'nullable|integer|min:0',
            'interval_usage' => 'nullable|integer|min:0',
        ]);
        ServiceType::create($data);
        return redirect()->route('servicetype.index')->with('success', 'Service Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceType $serviceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceType $servicetype)
    {
        $arr['servicetype'] = $servicetype;
        $arr['jenises'] = \App\Models\Jenis::orderBy('name', 'asc')->get();
        return view('service_type.edit', $arr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceType $servicetype)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'jenis_id' => 'required|exists:jenis,id',
            'interval_month' => 'nullable|integer|min:0',
            'interval_usage' => 'nullable|integer|min:0',
        ]);
        $servicetype->update($data);
        return redirect()->route('servicetype.index')->with('success', 'Service Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceType $servicetype)
    {
        // dd($serviceType);
        if ($servicetype->services()->count() > 0) {
            return redirect()->route('servicetype.index')->with('error', 'Cannot delete Service Type with associated Services.');
        }
        $servicetype->delete();
        return redirect()->route('servicetype.index')->with('success', 'Service Type deleted successfully.');
    }
}
