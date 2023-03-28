<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FranchiseLocationResource;
use App\Models\Franchise;
use Illuminate\Http\Request;
use App\Http\Resources\FranchiseResource;
use App\Models\BogoExtra;
use App\Models\BogoModifier;
use App\Models\Contact;
use App\Models\Promotion;
use App\Models\Review;

class FranchiseController extends Controller
{
    public function locations(Request $request)
    {
        $request->validate([
            'isPickUp' => 'required',
        ]);
        $locations = Franchise::select('id','payment_method','address','lat','lng','pickup','delivery','status')->where('status','active')->where($request->isPickUp == 0? 'delivery':'pickup',1)->get();
        if(!$locations){
            return response([
                'success' => false,
                'error' => true,
                'message' => 'franchise not found',
            ]);
        }
        return response([
            'success' => true,
            'franchises' => FranchiseLocationResource::collection($locations),
        ]);
    }
    public function all($type = '')
    {

        $franchises = Franchise::where('status','active')->get();
        $promotions = Promotion::where('on_all_franchises',1)->get();
        if(!$franchises){
            return response([
                'success' => false,
                'error' => true,
                'message' => 'franchise not found',
            ]);
        }
        return  response([
            'success' => true,
            'franchises' => FranchiseResource::collection($franchises),
            //'franchises' => $franchises,
           // 'commonPromotions' => $promotions,

           /// 'franchises' => FranchiseResource::collection($franchises),
        ]);;
    }

    public function single($id)
    {
        $franchise = Franchise::with('workingHours')->where('id',$id)->where('status','active')->first();
        if(!$franchise){
            return response([
                'success' => false,
                'error' => true,
                'message' => 'franchise not found',
            ]);
        }
        return response([
            'success' => true,
            'franchises' => FranchiseResource::collection($franchise),
        ]);

    }

    public function byIds(Request $request)
    {
        $request->validate([
            'franchises' => 'required',
        ]);
        // $explode_id = json_decode($request->franchises, true);
        // $franchise = Franchise::whereIn('id',$request->franchises)->get();
        $explode_id = json_decode($request->franchises, true);
        //  $franchise = Franchise::whereIn('id',$explode_id)->with(['promotions' => function ($query) {
        //     $query->where('on_all_franchises', 1);
        // }])->get();
     // //  return Franchise::whereIn('id',$explode_id)->where('status','active')->with(['promotions' => fn ($builder) => $builder->where('all_franchise', 1)])->get();

       $franchise = Franchise::whereIn('id',$explode_id)->where('status','active')->get();
        if(!$franchise){
            return response([
                'success' => false,
                'error' => true,
                'message' => 'franchise not found',
            ]);
        }
        return response([
            'success' => true,
            'franchises' => FranchiseResource::collection($franchise),


        ]);

    }

    public function contact(Request $request)
    {

        $request->validate([
            'message' => 'required',
        ]);
        $contact = new Contact;
        $contact->message = $request->message;
        $contact->user_id = $request->user_id;
        $contact->save();
        return response([
            'success' => true,
            'message' => 'contact request has been submited',
        ]);
    }







}
