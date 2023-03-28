<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \Spatie\Activitylog\Models\Activity;
class ActivitylogController extends Controller
{
    public function index(){
       // activity()->log('Look mum, I logged something');
         $activity =  Activity::all();
         return view('admin.activity.index',compact('activity'));
    }
}
