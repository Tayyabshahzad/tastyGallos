<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\Datatables\Datatables;
class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $categories = Category::withCount('products');
            return DataTables::of($categories)
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.categories.index');
    }
    public function store(Request $request){
        $request->validate([
            'status' => 'required',
            'name' => 'required',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'status' => $request->status
         ]);


        // $category = new Category;
        // $category->name = $request->name;
        // $category->status = $request->status;
        if($category->save()){
            return response(['success' => true,'message' => 'Category has been created successfully']);
        }else{
            return response(['success' => false,'message' => 'Category not created']);
        }
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $category =  Category::findOrFail($request->id);
        $category->name = $request->name;
        $category->status = $request->status;
        if($category->save()){
            return response(['success' => true,'message' => 'Category has been updated successfully']);
        }else{
            return response(['success' => false,'message' => 'Category not updated']);
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $category =  Category::findOrFail($request->id);
        if($category->delete()){
            return response(['success' => true,'message' => 'Category has been deleted successfully']);
        }else{
            return response(['success' => false,'message' => 'Category not deleted']);

        }
    }
}
