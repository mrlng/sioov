<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'asc')->get();
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('users.customers.index', compact('customers'));
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
        return view('users.customers.create', compact('randomString'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'customer_name' => 'required',
            'phone' => 'required',
        ]);
        Customer::create($request->all());
        Alert::toast('Data has been saved!', 'success');
        return redirect()->route('customers.index');
    }

    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('items.show', compact('customer'));
    }

    public function edit(string $id)
    {
        $customers = Customer::findOrFail($id);
        return view('users.customers.edit', compact('customers'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer_name' => 'required',
            'phone' => 'required',
        ]);
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        Alert::toast('Customer updated successfully', 'success');
        return redirect()->route('customers.index');
    }

    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        try {
            $customer->delete();
        } catch (\Exception $e) {
            Alert::toast('Failed to delete customer ', 'error');
            return back();
        }
        Alert::toast('Customer deleted successfully', 'success');
        return redirect()->route('customers.index');
    }
}
