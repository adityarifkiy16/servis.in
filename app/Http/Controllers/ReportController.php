<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Service;
use App\Models\Departement;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr['departments']  = Departement::all();
        $arr['servicetypes'] = ServiceType::all();
        return view('report.index', $arr);
    }

    public function download(Request $request)
    {
        $query = Service::with(['serviceType', 'product']);

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
        $services = $query->get();

        // Kirim ke view sebagai array
        $data = [
            'services' => $services
        ];

        // Load view PDF
        $pdf = Pdf::loadView('service.pdf.report', $data);

        return $pdf->stream('Laporan_service_' . date('Y-m-d') . '.pdf');
    }
}
