<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->orderBy('created_at', 'asc')->get();
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $orders = Order::with('customer')->orderBy('created_at', 'asc')->get();
        $customers = Customer::orderBy('customer_name', 'asc')->get();
        $characters = '00112233445566778899';
        $randomString = '';
        for ($i = 0; $i < 4; $i++) 
        {
            $index = rand(0, strlen($characters));
            $randomString .= $characters[$index];
        }
        return view('orders.create', compact('customers', 'randomString'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'customer_id' => 'required',
            'paid' => 'required',
            'unpaid' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);
        Order::create($request->all());
        Alert::toast('Data has been saved!', 'success');
        return redirect()->route('jobs.create');
    }

    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('items.show', compact('order'));
    }

    public function edit(string $id)
    {
        $orders = Order::findOrFail($id);
        return view('orders.edit', compact('orders'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer_id' => 'required',
            'total_payment' => 'required',
            'paid' => 'required',
            'unpaid' => 'required',
        ]);
        $order = Order::findOrFail($id);
        $order->update($request->all());
        Alert::toast('Order updated successfully', 'success');
        return redirect()->route('orders.index');
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        try {
            $order->delete();
        } catch (\Exception $e) {
            Alert::toast('Failed to delete order ', 'error');
            return back();
        }
        Alert::toast('Order deleted successfully', 'success');
        return redirect()->route('orders.index');
    }
    public function customer_store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'customer_name' => 'required',
            'phone' => 'required',
        ]);
        Customer::create($request->all());
        Alert::toast('Data has been saved!', 'success');
        return back();
    }

}
