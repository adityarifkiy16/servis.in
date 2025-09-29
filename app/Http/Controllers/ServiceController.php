<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr['services'] = Service::with('serviceType', 'product')->orderBy('created_at', 'desc')->paginate(5);
        return view('service.index', $arr);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $servicetypes = ServiceType::all();
        $arr['products'] = Product::whereIn('jenis_id', $servicetypes->pluck('jenis_id'))->get();
        $arr['servicetypes'] = \App\Models\ServiceType::all();
        return view('service.create', $arr);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'service_type_id' => 'required|exists:service_type,id',
            'product_id' => 'required|exists:products,id',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $data['status'] = '0'; // Default status to 'Pending'

        Service::create($data);
        return redirect()->route('service.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $arr['service'] = $service;
        $servicetypes = ServiceType::all();
        $arr['products'] = Product::whereIn('jenis_id', $servicetypes->pluck('jenis_id'))->get();
        $arr['servicetypes'] = $servicetypes;
        return view('service.edit', $arr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'service_type_id' => 'required|exists:service_type,id',
            'product_id'      => 'required|exists:products,id',
            'description'     => 'nullable|string',
            'date'            => 'required|date',
            'status'          => 'nullable|in:0,1,2', // 0: Pending, 1: In Progress, 2: Completed
            'desc_tech'       => 'nullable|string',
        ]);

        if ($request->status == 2 && $service->status != 2) {
            $type = $service->serviceType;
            if ($type) {
                $nextDate = null;

                if ($type->interval_month) {
                    $nextDate = \Carbon\Carbon::parse($service->date)
                        ->addMonths($type->interval_month);
                }

                if ($nextDate) {
                    Service::create([
                        'product_id'      => $service->product_id,
                        'service_type_id' => $service->service_type_id,
                        'description'     => "Auto-generated service",
                        'date'            => $nextDate,
                        'status'          => 0, // new service pending
                    ]);
                }
            }
        }


        switch ($service->status) {
            // === CASE 0: Pending ===
            case 0:
                $service->update([
                    'status' => $request->status,
                    'desc_tech' => $request->desc_tech,
                    'service_type_id' => $request->service_type_id,
                    'product_id' => $request->product_id,
                    'description' => $request->description,
                    'date' => $request->date,
                ]);
                break;

            // === CASE 1: In Progress ===
            case 1:
                $service->update([
                    'status'    => $request->status,
                    'desc_tech' => $request->desc_tech,
                ]);
                break;

            // === CASE 2: Completed ===
            case 2:
                $service->update([
                    'desc_tech' => $request->desc_tech,
                ]);
                return redirect()->route('service.index')->with('error', 'Service is already completed.');
                break;
        }
        return redirect()->route('service.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('service.index')->with('success', 'Service deleted successfully.');
    }
}
