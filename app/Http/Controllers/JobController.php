<?php

namespace App\Http\Controllers;

use Alert;
use Validator;
use App\Models\Item;
use App\Models\Vendor;
use App\Models\Order;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Item::orderBy('created_at', 'asc')->get();
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        $orders = Order::with('customer')->orderBy('created_at', 'desc')->get();
        $characters = '00112233445566778899';
        $randomString = '';
        for ($i = 0; $i < 4; $i++) 
        {
            $index = rand(0, strlen($characters));
            $randomString .= $characters[$index];
        }
        return view('jobs.create', compact('orders', 'randomString'));
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'order_id' => 'required',
            'item' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'unit' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        try {
            $amount = $req->price * $req->qty;
        } catch (\Exception $e) {
            Alert::toast('Failed to calculate amaount item', 'error');
            return back();
        }
        try {
        Item::create([
            'id' => $req->id,
            'order_id' => $req->order_id,
            'item' => $req->item,
            'price' => $req->price,
            'qty' => $req->qty,
            'unit' => $req->unit,
            'amount' => $amount,
            'production' => 'belum dikerjakan',
        ]);
    } catch (\Exception $e) {
        Alert::toast('Failed to calculate amaount item', 'error');
        return back();
    }
        Alert::toast('Success created data', 'success');
        return redirect()->route('orders.index');
    }

    public function show(string $id)
    {
        $vendors = Vendor::all();
        $item = Item::findOrFail($id);
        return view('jobs.detail', compact('item', 'vendors'));
    }

    public function edit(string $id)
    {
        $items = Item::findOrFail($id);
        return view('items.edit', compact('items'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'production' => 'required',
        ]);
        $item = Item::findOrFail($id);
        $item->update($request->all());
        Alert::toast('Success updated data', 'success');
        return redirect()->route('jobs.index');
    }

    public function update_design(Request $request, string $id)
    {
        $request->validate([
            'production' => 'required',
            // 'employee_id' => 'required',
        ]);
        $item = Item::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('jobs.index')
            ->with('success', 'Item updated successfully.');
    }

    public function update_production(Request $request, string $id)
    {
        $request->validate([
            'production' => 'required',
            'vendor_id' => 'required',
        ]);
        $item = Item::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('jobs.index')
            ->with('success', 'Item updated successfully.');
    }

    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        Alert::toast('Items deleted successfully', 'success');
        return redirect()->route('jobs.index');
    }
}
