<?php

namespace App\Http\Controllers;

use App\Models\PaymentTerm;
use App\Models\ShipVia;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
    public function paymentTermIndex(Request $request){
        if ($request->ajax()) {
            $data = PaymentTerm::select(['id', 'name']);
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
            return '<button class="btn btn-sm btn-info editBtn" data-id="'.$row->id.'" data-name="'.e($row->name).'">Edit</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('vendors.payment-terms.index');
    }
    public function paymentTermsStore(Request $request){
        $term = PaymentTerm::updateOrCreate(
            ['id' => $request->id],
            ['name' => $request->name]
        );

        return response()->json(['message' => $request->id ? 'Updated successfully' : 'Created successfully']);
    }

    public function shipViaIndex(Request $request){
        if ($request->ajax()) {
            $data = ShipVia::select(['id', 'name']);
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
            return '<button class="btn btn-sm btn-info editBtn" data-id="'.$row->id.'" data-name="'.e($row->name).'">Edit</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('vendors.ship-via.index');
    }
    public function shipViaStore(Request $request){
        $term = ShipVia::updateOrCreate(
            ['id' => $request->id],
            ['name' => $request->name]
        );

        return response()->json(['message' => $request->id ? 'Updated successfully' : 'Created successfully']);
    }
}
