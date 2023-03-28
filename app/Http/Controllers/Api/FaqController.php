<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use Illuminate\Http\Request;
use App\Models\Faq;
class FaqController extends Controller
{
     public function index(){
        $faqs = Faq::get();
        return response([
            'success'=>true,
            'faqs'=> FaqResource::collection($faqs),
        ]);
     }
}
