<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::orderBy('created_at', 'asc')->get();
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('users.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('users.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'phone' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        User::create([
            'name' => $request['name'],
            'position' => $request['position'],
            'phone' => $request['phone'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
        ]);
        Alert::toast('Data has been saved!', 'success');
        return redirect()->route('employees.index')->with('success', 'berhasil');
    }

    public function show(string $id)
    {
        $employee = User::findOrFail($id);
        return view('users.employees.show', compact('employee'));
    }

    public function edit(string $id)
    {
        $employees = User::findOrFail($id);
        return view('users.employees.edit', compact('employees'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'phone' => 'required',
        ]);
        $employee = User::findOrFail($id);
        $employee->update($request->all());
        Alert::toast('Employee updated successfully', 'success');
        return redirect()->route('employees.index');
    }

    public function destroy(string $id)
    {
        $employee = User::findOrFail($id);
        try {    
        $employee->delete();
        } catch (\Exception $e) {
            Alert::toast('Failed to delete employee ', 'error');
            return back();
        }
        Alert::toast('Employee deleted successfully', 'success');
        return redirect()->route('employees.index');
    }
}
