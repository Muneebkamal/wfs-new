<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\PaymentTerm;
use App\Models\ShipVia;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $data = Vendor::select([
                'id',
                'name',
                'vendor_alias',
                'address',
                'address1',
                'city',
                'state',
                'country',
                'zip_code',
                'phone',
                'contact_name',
                'contact_email',
                'other_method as order_method',
                'map',
                'notes',
                'paymet_term as payment_terms', // or change to 'payment_term' everywhere
                'currecncy'
            ]); // Use your Vendor model
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $editBtn = '<a href="'.route('vendors.edit', $row->id).'" class="btn btn-sm btn-primary">Edit</a>';
                $deleteBtn = '<form action="'.route('vendors.destroy', $row->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                            </form>';
                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('vendors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paymetTerms = PaymentTerm::all();
        return view('vendors.create',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
            'name'           => 'required|string|max:255',
            'vendor_alias'   => 'nullable|string|max:255',
            'address'        => 'nullable|string|max:255',
            'address1'       => 'nullable|string|max:255',
            'city'           => 'nullable|string|max:255',
            'state'          => 'nullable|string|max:255',
            'country'        => 'nullable|string|max:255',
            'zip_code'       => 'nullable|string|max:20',
            'contact_name'   => 'nullable|string|max:255',
            'contact_email'  => 'nullable|email|max:255',
            'other_method'   => 'nullable|string|max:255',
            'map'            => 'nullable|boolean',
            'paymet_term'    => 'nullable|exists:payment_terms,id',
            'currecncy'      => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $vendor = new Vendor();
        $vendor->name           = $request->name;
        $vendor->vendor_alias   = $request->vendor_alias;
        $vendor->address        = $request->address;
        $vendor->address1       = $request->address1;
        $vendor->city           = $request->city;
        $vendor->state          = $request->state;
        $vendor->country        = $request->country;
        $vendor->zip_code       = $request->zip_code;
        $vendor->contact_name   = $request->contact_name;
        $vendor->contact_email  = $request->contact_email;
        $vendor->other_method   = $request->other_method;
        $vendor->map            = $request->has('map') ? 1 : 0;
        $vendor->paymet_term    = $request->paymet_term;
        $vendor->currecncy      = $request->currecncy;

        $vendor->save();

        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
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
        $paymentTerms = PaymentTerm::all();
        return view('vendors.edit', compact('vendor','paymentTerms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $data = $this->validateRequest($request);
        $vendor->update($data);
        return redirect()->route('vendors.index')->with('success', 'Vendor updated!');
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
    public function locationIndex(Request $request)
    {
        return view('vendors.locations.index');
    }
    public function getLocationData()
    {
        $locations = Location::query();
        return DataTables::of($locations)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            return '<a href="'.route('locations.edit', $row->id).'" class="btn btn-sm btn-primary">Edit</a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    public function createLocation()
    {
        return view('vendors.locations.create');
    }
    public function storeLocation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:100',
            'first_name' => 'nullable|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'suffix' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'emails' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'mobile' => 'nullable|string|max:50',
            'fax' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        Location::create($request->all());

        return redirect()->route('locations.index')->with('success', 'Location created successfully.');
    }
    public function editLocation($id){
        $location = Location::find($id);
        return view('vendors.locations.edit',get_defined_vars());
    }
    public function updateLocation(Request $request, $id)
    {
        $location = Location::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title'         => 'nullable|string|max:100',
            'first_name'    => 'nullable|string|max:100',
            'middle_name'   => 'nullable|string|max:100',
            'last_name'     => 'nullable|string|max:100',
            'suffix'        => 'nullable|string|max:50',
            'company'       => 'nullable|string|max:255',
            'emails'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:20',
            'mobile'        => 'nullable|string|max:20',
            'fax'           => 'nullable|string|max:20',
            'website'       => 'nullable|url|max:255',
            'street'        => 'nullable|string|max:255',
            'city'          => 'nullable|string|max:100',
            'state'         => 'nullable|string|max:100',
            'zip'           => 'nullable|string|max:20',
            'country'       => 'nullable|string|max:100',
        ]);

        $location->update($validated);

        return redirect()->route('locations.index')->with('success', 'Location updated successfully.');
    }
    protected function validateRequest($request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'vendor_alias' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'address1' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'contact_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'other_method' => 'nullable|string|max:255',
            'map' => 'nullable|boolean',
            'paymet_term' => 'nullable|integer|exists:payment_terms,id',
            'currecncy' => 'nullable|string|max:3',
        ]);
    }
}
