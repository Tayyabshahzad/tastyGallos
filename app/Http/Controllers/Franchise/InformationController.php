<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\FranchiseWorkingHour;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InformationController extends Controller
{
    public function index()
    {
        $user = Auth()->user();
        $franchise = Franchise::where('user_id',$user->id)->with('workingHours')->first();
        return view('franchise.information',compact('franchise'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'edit_id' => 'required',
            'user_id' => 'required',
            'workingHourId' => 'required',
            'pickup' => 'required_without_all:delivery|string|max:3',
            'delivery' => 'string|max:3',
            'lat' => 'required',
            'estimated_time' => 'required',
            'lng' => 'required',

        ]);
        $franchise = Franchise::findOrFail($request->edit_id);
        $franchise->name = $request->franchise_name;
        $franchise->contact_phone = $request->franchise_phone;
        $franchise->contact_email =  $request->contact_email;
        $franchise->vat =  $request->franchise_vat;
        $franchise->address =  $request->franchise_address;
        $franchise->delivery_charge = $request->delivery_charge;
        $franchise->about =  $request->about_franchise;
        $franchise->busy_time =  $request->busy_time;
        $franchise->free_time =  $request->free_time;
        $franchise->lat = $request->lat;
        $franchise->lng = $request->lng;
        $franchise->bank =  $request->bank;
        $franchise->account_holder =  $request->account_holder;
        $franchise->branch =  $request->branch;
        $franchise->account_number =  $request->account_number;
        $franchise->estimated_time = $request->estimated_time;
        $franchise->franchiseTimings = $request->franchiseTimings;
        if ($request->pickup == 'yes') {
            $franchise->pickup =  true;
        } else {
            $franchise->pickup =  false;
        }
        if ($request->delivery == 'yes') {
            $franchise->delivery =  true;
        } else {
            $franchise->delivery =  false;
        }
        foreach ($request->workingHourId as $item => $v) {
            $data = array(
                'opening_time' => $request->opening_time[$item],
                'closing_time' => $request->closing_time[$item],
                'status' => $request->time_status[$item],
            );
            $workingHours  =  FranchiseWorkingHour::where('id', $request->workingHourId[$item])->first();
            $workingHours->update($data);
        }
        if ($franchise->save()) {
            if ($request->hasFile('franchise_banner')) {
                $franchise->clearMediaCollection('franchise_banner');
                $franchise->addMediaFromRequest('franchise_banner')->toMediaCollection('franchise_banner');
            }
            $user = User::findOrFail($request->user_id);
            $user->name = $request->admin_name;
            if ($user->save()) {
                return redirect()->back()->with('success', 'Franchise information has been updated successfully');
            } else {
                return redirect()->back()->with('error', 'Franchise not updated');
            }
        }
    }


    public function profile()
    {
        $user = Auth::user();
        return view('franchise.profile', compact('user'));
    }
    public function profileUpdate(Request $request){
        $request->validate([
            'password' => 'required_with:password|same:password_confirmation',
        ]);
        $user = Auth::user();

        if ($request->password == '') {
            $password = $user->password;
        } else {
            $password = Hash::make($request->password);
        }
        $user->name = $request->user_name;
        $user->password = $password;
        if($user->save()){
            if($request->hasFile('profile_photo')) {
                $user->clearMediaCollection('profile_photo');
                $user->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');
            }
            return response(['success' => true,'message' => 'Setting has been updated successfully']);
        }
    }
}
