<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Extra;
use App\Models\Franchise;
use App\Models\Modifier;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $products = Product::with('categories')->orderby('id', 'desc');
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('categories',function($products){
                    $cat = '';
                    foreach ($products->categories as $categories) {
                       $cat .= '<button class="btn btn-outline-secondary btn-sm">'. $categories->name .'</button> ';
                    }
                    return $cat;

                })
                ->rawColumns(['categories'])
                ->make(true);
        }
        return view('admin.product.index');
    }

    public function create()
    {
        $modifiers  = Modifier::where('status', 'active')->get();
        $categories = Category::where('status', 'active')->get();
        return view('admin.product.create', compact('categories', 'modifiers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'vat' => 'required|min:0|max:100',
            'sell_on_its_own' => 'required',
            'status' => 'required',
            //'photos' => 'array',
            //'photos.*' => 'required|image|mimes:jpg,png,gif',
        ]);
        //dd($request->sale_price);
        if($request->sale_price == null or $request->sale_price == '' ){
            $finalPrice =  $request->price;
        }else{
            $finalPrice =  $request->sale_price;
        }
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->sell_on_its_own = $request->sell_on_its_own;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->vat = $request->vat;
        $product->status = $request->status;
        $product->final_price = $finalPrice;
        if ($product->save()) {
           // $products = Franchise::all()->pluck('id');
            //$product->franchises()->syncWithPivotValues($products , ['status' =>'active']);
            if ($request->hasFile('photos')) {
                $fileAdders = $product->addMultipleMediaFromRequest(['photos'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('products');
            }); }
         //   if ($product->sell_on_its_own == 'yes') {
                $product->categories()->attach($request->categories);
                $product->modifierGroups()->attach($request->modifiers);
          //  }
            return redirect()->route('admin.products')->with('success', 'Product has been added successfully');
        } else {
            return redirect()->back()->with('error', 'Product not added');
        }
    }
    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $photos = $product->getMedia('products');
        $categories = Category::where('status', 'active')->get();
        $assign_categories = $product->categories->pluck('id')->toArray();
        $modifiers  = Modifier::where('status', 'active')->get();
        $extras = Extra::where('status','active')->get();
        $assign_modifiers = $product->modifierGroups->pluck('id')->toArray();
        $assign_extras = $product->extras->pluck('id')->toArray();
        return view('admin.product.edit', compact('product', 'categories', 'assign_categories', 'modifiers', 'assign_modifiers','photos','extras','assign_extras'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'vat' => 'min:0|max:100',
            'status' => 'required',
            'sell_on_its_own' => 'required',

            //'photos' => 'mimes:.jpeg,.jpg,.png | max:1000',
        ]);
        $product =  Product::findOrFail($request->id);

        if($request->sale_price == null or $request->sale_price == '' ){
            $finalPrice =  $request->price;
        }else{
            $finalPrice =  $request->sale_price;
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->sell_on_its_own = $request->sell_on_its_own;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->vat = $request->vat;
        $product->status = $request->status;
        $product->final_price = $finalPrice;
        if ($product->save()) {
            // if($request->has('extras')){
            //     $product->extras()->syncWithPivotValues($request->extras,['price' => 0]);
            // }
            if ($request->hasFile('photos')) {
                $fileAdders = $product->addMultipleMediaFromRequest(['photos'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('products');
            }); }

            // if ($product->sell_on_its_own == 'yes') {
            //     $product->categories()->sync($request->categories);
            //     $product->modifierGroups()->sync($request->modifiers);
            // } else {
            //     $product->categories()->detach($request->categories);
            //     $product->modifierGroups()->detach($request->modifiers);
            // }
            $product->extras()->syncWithPivotValues($request->extras,['price'=>0]);
            $product->categories()->sync($request->categories);
            $product->modifierGroups()->sync($request->modifiers);


            return redirect()->route('admin.products')->with('success', 'Product has been updated successfully');
        } else {
            return redirect()->back()->with('error', 'Product not updated');
        }
    }
    public function delete(Request $request)
    {
        $product =  Product::findOrFail($request->id);
        if ($product->delete()) {
            return response(['success' => true, 'message' => 'Product has been deleted successfully']);
        } else {
            return response(['success' => false, 'message' => 'Product not deleted']);
        }
    }

    public function photoDelete(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'product' => 'required',
        ]);
        $product    = Product::findOrFail($request->product);
        $photos = $product->getMedia('products');
        $image = $photos->where('id',$request->id)->first();
        if($image->delete()){
            return response(['success' => true, 'message' => 'Product photo been deleted successfully']);
        }else{
            return response(['success' => false, 'message' => 'Photo not removed']);
        }

    }
}
