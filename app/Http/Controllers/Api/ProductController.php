<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SingleProductResource;
use App\Models\Franchise;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index($id)
    {

        Session::forget('franchise_id_for_getting_product');
        Session::put('franchise_id_for_getting_product',$id);

      //  $this->specialPrice->where('franchise_id',Session::get('franchise_id_for_getting_product', 'default'))->first()->price ?? $this->final_price,
      // return $franchise = Franchise::with('active_products')->find($id);


        $products = Product::with(['promotions' => function ($query) {
            $query->where('is_schedule',true);
        }])->get();

        // return $products = Product::with('productStatus')->whereHas('productStatus',function($query){
        //      $query->where('status','<>','inactive')->count();
        // })->get();
    //    return $products = Product::with('productStatus')->whereHas('productStatus', function($query) {
    //         $query->where('status', '<>', 'inactive');
    //      ])->get();

        return response([
            'success' => true,
            'product' =>  ProductResource::collection($products),
        ]);
    }
    public function single($id)
    {
        $product = Product::find($id);
        // foreach ($product->modifierGroups as $modifiers) {
        //    return  $modifiers->items;
        // }
        //
            ///
        return response([
            'success' => true,
            'product' => new SingleProductResource($product),
        ]);
    }
}
