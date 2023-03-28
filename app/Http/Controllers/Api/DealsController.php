<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DealResource;
use App\Models\Deal;
use App\Models\Franchise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DealsController extends Controller
{
    public function deals($id){
        // New Detausssdsdsldfldj
        Session::forget('franchise_id_for_getting_product');
        Session::put('franchise_id_for_getting_product',$id);
        //$deals = Deal::where('status','active')->with('products')->get();
        $franchise = Franchise::select('id','name')->with('deals')->where('id',$id)->first();
        if(!$franchise){
            return response([
                'success'=> false,
            ]);
        }
        return response([
                'success'=> true,
                'deals' => DealResource::collection($franchise->deals),
        ]);
    }
}
