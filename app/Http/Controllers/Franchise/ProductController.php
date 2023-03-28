<?php

namespace App\Http\Controllers\Franchise;
use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\Product;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
class ProductController extends Controller
{
   public function products(Request $request)
   {
    if ($request->ajax()) {
        $user = Auth()->user();
        $franchise = Franchise::select('id')->where('user_id',$user->id)->first();
        //$products = Product::withCount('categories')->with('specialPrice')->where('status','!=' ,'inactive');
        $products = Product::with('categories','specialPrice')->orderby('id', 'desc');
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('specialPrice', function ($products) {

                foreach ($products->specialPrice as $price) {
                    return $price = $price->price;
                }

            })
            ->rawColumns(['specialPrice'])

            ->setRowClass(function ($products){
                $today = Carbon::now()->format('Y-m-d');
                $promotionsDiscount = Promotion::where('isCanceled',0)->where('end_date_time','>=',$today)->get();
                if($promotionsDiscount != null){
                    foreach($promotionsDiscount as $promotion){
                        $endDate =  Carbon::parse($promotion->end_date_time);
                        if($promotion->on_all_franchises == 1){
                            if($promotion->type == 'bogo'){
                                if($promotion->buy_product_id == $products->id){
                                    return 'bg-light-danger';
                                }
                            }else{
                                $promotionsDiscount = Promotion::whereOnAllFranchises(1)->with('products')->get();
                                foreach($promotion->products as $product){
                                    if($product->id == $products->id){
                                        return 'bg-light-warning';
                                    }
                                }
                            }

                        }else if($promotion->on_all_franchises == 0){
                            foreach($promotion->franchises as $franchise){
                                if($franchise->id == $franchise->id){
                                    if($promotion->type == 'bogo'){
                                        if($promotion->buy_product_id == $products->id){
                                            return 'bg-light-info';
                                        }
                                    }else{
                                        $promotionsDiscount = Promotion::whereOnAllFranchises(0)->with('products')->get();
                                        foreach($promotion->products as $product){
                                            if($product->id == $products->id){
                                                return 'bg-light-success';
                                            }
                                        }
                                    }
                                }

                            }

                        }
                    }
                }


                // if ($promotions->count() > 0 or $products->promotions->count() > 0) {

                // }
            })
            ->make(true);
    }
    return view('franchise.products');
   }

   public function products2(Request $request)
   {
       $franchise_id =  $request->franchiseId;
       $GLOBALS['id']  = $franchise_id;
       $products = Product::with('categories','specialPrice')->orderby('id', 'desc');
       return DataTables::of($products)
           ->addColumn('categories', function ($products) {
               $product_cat = '';
               foreach ($products->categories as $category) {
                   $product_cat .= "<button class='btn btn-sm btn-outline-primary btn-square'> $category->name  </button> &nbsp;";
               }
               return $product_cat;
           })->addColumn('specialPrice', function ($products) {
               if ($products->specialPrice) {
                   $price = $products->specialPrice->price;
               } else {
                   $price = '';
               }
               return  $price;
           })
           ->addColumn('productStatus',function($product){

                   if($product->productStatus){
                       return 'inactive';
                   }else{
                       return 'active';
                   }

           })
           ->rawColumns(['categories', 'promotions', 'specialPrice'])
           ->setRowClass(function ($products){
               $today = Carbon::now()->format('Y-m-d');
               $promotionsDiscount = Promotion::where('isCanceled',0)->where('end_date_time','>=',$today)->get();
               if($promotionsDiscount != null){
                   foreach($promotionsDiscount as $promotion){
                       $endDate =  Carbon::parse($promotion->end_date_time);
                       if($promotion->on_all_franchises == 1){
                           if($promotion->type == 'bogo'){
                               if($promotion->buy_product_id == $products->id){
                                   return 'bg-light-danger';
                               }
                           }else{
                               $promotionsDiscount = Promotion::whereOnAllFranchises(1)->with('products')->get();
                               foreach($promotion->products as $product){
                                   if($product->id == $products->id){
                                       return 'bg-light-warning';
                                   }
                               }
                           }

                       }else if($promotion->on_all_franchises == 0){
                           foreach($promotion->franchises as $franchise){
                               if($franchise->id == $GLOBALS['id']){
                                   if($promotion->type == 'bogo'){
                                       if($promotion->buy_product_id == $products->id){
                                           return 'bg-light-info';
                                       }
                                   }else{
                                       $promotionsDiscount = Promotion::whereOnAllFranchises(0)->with('products')->get();
                                       foreach($promotion->products as $product){
                                           if($product->id == $products->id){
                                               return 'bg-light-success';
                                           }
                                       }
                                   }
                               }

                           }

                       }
                   }
               }


               // if ($promotions->count() > 0 or $products->promotions->count() > 0) {

               // }
           })
           ->addIndexColumn()
           ->make(true);
   }

}
