<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::orderBy('created_at', 'asc')->get();
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
        $characters = '00112233445566778899';
        $randomString = '';
        for ($i = 0; $i < 4; $i++) 
        {
            $index = rand(0, strlen($characters));
            $randomString .= $characters[$index];
        }  
        return view('vendors.create', compact('randomString'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'vendor_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        Vendor::create($request->all());
        Alert::toast('Data has been saved!', 'success');
        return redirect()->route('vendors.index');
    }

    public function show(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('items.show', compact('vendor'));
    }

    public function edit(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'vendor_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        $vendor = Vendor::findOrFail($id);
        $vendor->update($request->all());
        Alert::toast('Vendor updated successfully', 'success');
        return redirect()->route('vendors.index');
    }

    public function destroy(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        try {
            $vendor->delete();
        } catch (\Exception $e) {
            Alert::toast('Failed to delete customer ', 'error');
            return back();
        }
        
        Alert::toast('Vendor deleted successfully', 'success');
        return redirect()->route('vendors.index');
    }
}
