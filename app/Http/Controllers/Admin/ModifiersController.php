<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modifier;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ModifiersController extends Controller
{
    public function index(Request $request)
    {
        $modifiers = Modifier::withCount('items');
        if ($request->ajax()) {
            return Datatables::of($modifiers)
                ->addIndexColumn()
                ->addColumn('product',function($modifiers){
                    $attachProducts = '';
                    foreach ($modifiers->products as $product) {
                       $attachProducts .= '<button class="btn btn-outline-secondary btn-sm mt-2">'. $product->name.' </button> ';
                    }
                    return $attachProducts;
                })
                ->rawColumns(['product'])
                ->make(true);
        }
        return view('admin.modifiers.index');
    }
    public function create()
    {
        $items = Product::where('status','active')->get();
        return view('admin.modifiers.create', compact('items'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'items' => 'required',
            'select_min_options' => 'required|integer|max:40',
            'select_max_options' => 'required|integer|max:40',
            'option_selected_times' => 'required|integer|max:40',
            'status' => 'required'
        ]);
        $modifier = new Modifier;
        $modifier->name = $request->name;
        $modifier->select_min_options =    $request->select_min_options;
        $modifier->select_max_options =    $request->select_min_options;
        $modifier->option_selected_times = $request->option_selected_times;
        if($request->choose_quantity){
            $modifier->choose_quantity =   true;
        }else{
            $modifier->choose_quantity =   false;
        }
        $modifier->status = $request->status;
        // $myArra = [1 => ['price' => 10],4 => ['price' => 20]];
        if ($modifier->save()) {
            $products = Product::select('id','final_price','price')->whereIn('id', $request->items)->get();
            $itemListed = $products->pluck('final_price','id')->map(function ($price) {
                return ['price' => $price];
            });
            $modifier->items()->sync($itemListed);
            return redirect()->route('admin.modifiers')->with('success', 'Modifier has been created successfully');
        } else {
            return redirect()->back()->with('error', 'Modifier not created');
        }
    }
    public function edit($id)
    {
        $modifier =  Modifier::findOrFail($id);
        $items = Product::where('status','active')->get();
        $assign_items = $modifier->items->pluck('id')->toArray();
        return view('admin.modifiers.edit', compact('modifier', 'items', 'assign_items'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'max:50',
            'select_min_options'    => 'integer|max:40',
            'select_max_options'    => 'integer|max:40',
            'option_selected_times' => 'integer|max:40',
            'status' => 'required',
            'edit_id' => 'required',
        ]);

        $modifier =  Modifier::findOrFail($request->edit_id);
        $modifier->name = $request->name;
        $modifier->select_min_options = $request->select_min_options;
        $modifier->select_max_options = $request->select_max_options;
        $modifier->option_selected_times = $request->option_selected_times;
        $modifier->status = $request->status;
        if($request->choose_quantity){
            $modifier->choose_quantity =   true;
        }else{
            $modifier->choose_quantity =   false;
        }
        $itemInRequest = [];
        $itemInDatabase = [];
        $itemInDB = $modifier->items->pluck('id')->toArray();
        $itemInRe = array_map('intval', $request->newItems, []);
        $commonValues = array_intersect($itemInDB, $itemInRe);
        $newItems = array_diff($itemInRe, $itemInDB);
        // Updating Products

        if (count($commonValues) > 0) {
            foreach ($commonValues as $values) {
               // dd($request->prices[$values]);
                $updateRecord[$values] =  ['price' => $request->prices[$values]];
            }
            $modifier->items()->sync($updateRecord);
            if (count($newItems) > 0) {
                foreach ($newItems as $newValue) {
                    $product = Product::select('id','price','final_price')->where('id', $newValue)->first();
                    $newRecord[$newValue] =  ['price' => $product->final_price];
                }
                $modifier->items()->attach($newRecord);
            }
        }else{

            foreach ($newItems as $newValue) {
                $product = Product::select('id','price','final_price')->where('id', $newValue)->first();
                $newRecord[$newValue] =  ['price' => $product->final_price];
            }
            $modifier->items()->sync($newRecord);
        }

        // Inserting New Products
        // $itemInRe = $request->newItems;
        //$MYARR = array(0=>array('item_id'=>1,'price'=>299),1=>array('item_id'=>2,'price'=>199));
        //    $prices = collect($request->input('newItems',[]))
        //    ->map(function($price){
        //     return ['items' => $price];
        //    });
        //dd($prices->toArray());
        // $modifier->items()->sync($prices);

        if ($modifier->save()) {
            return redirect()->route('admin.modifiers')->with('success', 'Modifier has been updated successfully');
        } else {
            return redirect()->back()->with('error', 'Modifier not updated');
        }
    }
    public function singleItemUpdate(Request $request)
    {
        $request->validate([
            'item_id' => 'integer|required',
            'modifier_id' => 'integer|required',
            'item_price' => 'integer|required'
        ]);
        $modifier =  Modifier::findOrFail($request->modifier_id);
        $modifier->items()->sync([$request->item_id => ['price' => $request->item_price]], false);
        return response(['success' => true, 'message' => 'Item price has been updated successfully']);
    }

    public function singleItemDelete(Request $request)
    {
        $request->validate([
            'id' => 'integer|required',
            'modifier_id' => 'integer|required',
        ]);
        $modifier =  Modifier::findOrFail($request->modifier_id);
        $modifier->items()->detach([$request->id]);
        return response(['success' => true, 'message' => 'Item has been deleted successfully']);
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $modifier =  Modifier::findOrFail($request->id);
        if ($modifier->delete()) {
            return response(['success' => true, 'message' => 'Modifier has been deleted successfully']);
        } else {
            return response(['success' => false, 'message' => 'Modifier not deleted']);
        }
    }
    public function addItem(Request $request)
    {
        $request->validate([
            'items' => 'required',
            'modifier_id' => 'integer|required',
        ]);
        dd($request->items);
    }
}
