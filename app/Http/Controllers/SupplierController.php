<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Log;
use Auth;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //return suppliers view
    public function index()
    {
        return view('suppliers.index');
    }
    //get suppliers
    public function getSuppliers()
    {
        try {
            $suppliers = Supplier::with('supplierProducts')->orderByDesc('id')->paginate(10);
            return $suppliers;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to load data, Try again later.',500);
        }
    }
    //add supplier
    public function addSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
        ]);
        try {
            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->save();
            return 'success';
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to add supplier, Try again later.',400);
        }
    }
    //edit Supplier
    public function editSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
        ]);
        try {
            $supplier = Supplier::findOrFail($request->id);
            $supplier->name = $request->name;
            $supplier->save();
            return 'success';
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to update supplier, Try again later.',400);
        }
    }
    //delete Supplier
    public function destroy($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();
            return response()->json('success',200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json('Failed to delete supplier, Try again later.',400);
        }
    }
}
