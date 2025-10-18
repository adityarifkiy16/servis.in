<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\Departement;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:management_service', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $query = Service::with(['serviceType', 'product']);

        // Data dropdown
        $arr['departments']  = Departement::all();
        $arr['servicetypes'] = ServiceType::all();

        $query->when(isset($request->search), function ($q) use ($request) {
            $q->whereHas('product', function ($subQ) use ($request) {
                $subQ->where('name', 'LIKE', '%' . $request->search . '%');
            });
        });

        // Filter by Departemen (relasi lewat product)
        $query->when($request->department_id, function ($q) use ($request) {
            $q->whereHas('product', function ($subQ) use ($request) {
                $subQ->where('departement_id', $request->department_id);
            });
        });

        // Filter by Status
        $query->when(isset($request->status), function ($q) use ($request) {
            $q->where('status', $request->status);
        });

        // Filter by Layanan / Service Type
        $query->when($request->service_type_id, function ($q) use ($request) {
            $q->where('service_type_id', $request->service_type_id);
        });

        // Filter by Tanggal
        $query->when($request->date, function ($q) use ($request) {
            $q->whereDate('date', $request->date);
        });

        // Ambil data
        $arr['services'] = $query->latest()->paginate(5);

        // Tambahin supaya query string (filter) tetap ke-bawa ke pagination
        $arr['services']->appends($request->all());

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
            'status'          => 'required|in:0,1,2', // 0: Pending, 1: In Progress, 2: Completed
            'date'            => 'required|date', // 0: Pending, 1: In Progress, 2: Completed
            'desc_tech'       => 'nullable|string',
        ]);
        $user = auth()->user();
        if ($request->status) {
            if (!$user->hasPermission('update_status')) {
                return redirect()->route('service.index')->with('error', 'You do not have permission to update the status.');
            }
        }

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
