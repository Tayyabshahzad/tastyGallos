<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
class ExtrasController extends Controller
{
    public function index(Request $request)
    {

        if($request->ajax()){
            $extras = Extra::orderby('id', 'desc');
            return DataTables::of($extras)->addIndexColumn()->make(true);
        }
        return view('admin.product.extras.index');
    }
    public function create(){
        return view('admin.product.extras.create');
    }

    public function edit($id){
        $extra = Extra::findorFail($id);
        return view('admin.product.extras.edit',compact('extra'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:extras,name',
            'price' => 'required',
        ]);
        $extras = new Extra;
        $extras->name = $request->name;
        $extras->price = $request->price;
        $extras->status = $request->status;

        if($extras->save()){
            return redirect()->route('admin.extras')->with('success', 'Extras has been added successfully');
        }else{
            return redirect()->back()->with('error', 'Error while adding extras');
        }

    }


    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'id' => 'required',
        ]);
        $extra = Extra::findorFail($request->id);
        $extra->name = $request->name;
        $extra->price = $request->price;
        $extra->status = $request->status;

        if($extra->save()){
            return redirect()->route('admin.extras')->with('success', 'Extras has been updated successfully');
        }else{
            return redirect()->back()->with('error', 'Error while updating extras');
        }

    }


    public function delete(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $extra = Extra::findorFail($request->id);
        if($extra->delete()){
            return response(['success' => true, 'message' => 'Extra has been deleted successfully']);
        }else{
            return response(['success' => false, 'message' => 'Extra not deleted']);
        }

    }
}
