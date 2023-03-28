<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromotionBannerResource;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use App\Models\PromotionBanner;
use Illuminate\Http\Request;
class PromotionController extends Controller
{
    public function index()
    {
          $promotions = Promotion::get();
        //return PromotionCollection::collection($promotions);
        //  return PromotionCollection::collection(Promotion::all());
        // return response([
        //     'success' => true,
        //     'promotions' =>  PromotionCollection::collection(Promotion::all()),
        // ]);
        return PromotionResource::collection($promotions);
    }

    public function banners()
    {
         $promotions = PromotionBanner::get();
        //return PromotionCollection::collection($promotions);
        //  return PromotionCollection::collection(Promotion::all());
        return response([
            'success' => true,
            'banners' =>  PromotionBannerResource::collection($promotions),
        ]);
      //  return PromotionResource::collection($promotions);
    }
}
