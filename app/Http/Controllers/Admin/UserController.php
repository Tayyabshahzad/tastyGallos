<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Option;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{

    public function logOutUserManulally()
    {
        Auth::logout();
        return true;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::orderBy('id', 'desc');
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('role', function ($user) {
                    return $user->roles->pluck('name')->implode(',');

                })
                ->make(true);
        }
        return view('admin.users.index');
    }
    public function profile()
    {
        $user = Auth::user();
        $paygate_id = Option::where('option_name', 'paygate_id')->first();
        $reference_id = Option::where('option_name', 'reference_id')->first();
        $cms_firebase_server_key = Option::where('option_name', 'cms_firebase_server_key')->first();
        $app_firebase_server_key = Option::where('option_name', 'app_firebase_server_key')->first();
        $commission = Option::where('option_name', 'commission')->first();
        $firebase_api_key = Option::where('option_name', 'firebase_api_key')->first();
        $database_url = Option::where('option_name', 'database_url')->first();
        $auth_domain = Option::where('option_name', 'auth_domain')->first();
        $project_id = Option::where('option_name', 'project_id')->first();
        $storage_bucket = Option::where('option_name', 'storage_bucket')->first();
        $messaging_sender_id = Option::where('option_name', 'messaging_sender_id')->first();
        $app_id = Option::where('option_name', 'app_id')->first();
        $measurement_id = Option::where('option_name', 'measurement_id')->first();
        return view('admin.setting.profile',
        compact('user','paygate_id','reference_id','cms_firebase_server_key','app_firebase_server_key', 'commission','firebase_api_key','database_url','auth_domain','project_id','storage_bucket','messaging_sender_id','app_id','measurement_id'));
    }
    public function payFastUpdate(Request $request)
    {
        $request->validate([
            'paygate_id' => 'required',
            'reference_id' => 'required',
            'cms_firebase_server_key_id' => 'required',
            'app_firebase_server_key_id' => 'required',
            'paygate_id_value' => 'required',
            'reference_id_value' => 'required',
            'cms_firebase_server_key_value' => 'required',
            'app_firebase_server_key_value' => 'required',
            'commission_id' => 'required',
            'password' => 'required_with:password|same:password_confirmation',

            'firebase_api_key_value' => 'required',
            'database_url_value' => 'required',
            'auth_domain_value' => 'required',
            'project_id_value' => 'required',
            'storage_bucket_value' => 'required',
            'messaging_sender_id_value' => 'required',
            'app_id_value' => 'required',
            'measurement_id_value' => 'required',
        ]);
        $paygate_id = Option::where('id', $request->paygate_id)->first();
        $reference_id = Option::where('id', $request->reference_id)->first();
        $cms_firebase_server_key = Option::where('id', $request->cms_firebase_server_key_id)->first();
        $app_firebase_server_key = Option::where('id', $request->app_firebase_server_key_id)->first();
        $commissionId = Option::where('id', $request->commission_id)->first();


        $firebase_api_key = Option::where('id', $request->firebase_api_key_id)->first();
        $database_url =  Option::where('id', $request->database_url_id)->first();
        $auth_domain =  Option::where('id', $request->auth_domain_id)->first();
        $project_id =  Option::where('id', $request->project_id)->first();
        $storage_bucket =  Option::where('id', $request->storage_bucket_id)->first();
        $messaging_sender_id =  Option::where('id', $request->messaging_sender_id)->first();
        $app_id =  Option::where('id', $request->app_id)->first();
        $measurement =  Option::where('id', $request->measurement_id)->first();

        $paygate_id->option_value = $request->paygate_id_value;
        $reference_id->option_value = $request->reference_id_value;
        $cms_firebase_server_key->option_value = $request->cms_firebase_server_key_value;
        $app_firebase_server_key->option_value = $request->app_firebase_server_key_value;
        $commissionId->option_value = $request->commission_value;

        $firebase_api_key->option_value = $request->firebase_api_key_value;
        $database_url->option_value = $request->database_url_value;
        $auth_domain->option_value = $request->auth_domain_value;
        $project_id->option_value = $request->project_id_value;
        $storage_bucket->option_value = $request->storage_bucket_value;
        $messaging_sender_id->option_value = $request->messaging_sender_id_value;
        $app_id->option_value = $request->app_id_value;
        $measurement->option_value = $request->measurement_id_value;


        $user = Auth::user();
        if ($request->password == '') {
            $password = $user->password;
        } else {
            $password = Hash::make($request->password);
        }
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->password = $password;
        if ($paygate_id->save()) {
            $reference_id->save();
            $cms_firebase_server_key->save();
            $app_firebase_server_key->save();
            $commissionId->save();

            $firebase_api_key->save();
            $database_url->save();
            $auth_domain->save();
            $project_id->save();
            $storage_bucket->save();
            $messaging_sender_id->save();
            $app_id->save();
            $measurement->save();

            $user->save();
            if ($request->hasFile('profile_photo')) {
                $user->clearMediaCollection('profile_photo');
                $user->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');
            }
            return response(['success' => true, 'message' => 'Setting has been updated successfully']);
        }
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $user = User::findOrFail($request->id);
        if ($user->delete()) {
            $user->clearMediaCollection('profile_photo');
            return response(['success' => true, 'message' => 'User has been deleted']);
        } else {
            return response(['success' => false, 'message' => 'User not deleted']);
        }
    }

    public function update(Request $request)
    {
        // $image = $request->file('profile_photo');
        // $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $input = $request->all();
        $user = User::findOrFail($input['userId']);
        $user->name = $input['name'];
        $user->last_name = $input['last_name'];
        $user->phone = $input['phone'];
        $user->status = $input['status'];
        if ($input['password'] != '' or $input['password'] != null) {
            $user->password = Hash::make($input['password']);
        }

        if ($user->save()) {
            if ($request->has('profile_photo')) {
                $photo = 'user-' . $user->id . '-profile.' . $request->profile_photo->extension();
                $user->clearMediaCollection('profile_photo');
                $user->addMediaFromRequest('profile_photo')->usingName($photo)->toMediaCollection('profile_photo');
            }

            if ($user->status == 'inactive') {
                $token = $user->notification_token;
                $url = 'https://fcm.googleapis.com/fcm/send';
                $FcmToken = [$user->notification_token];
                $serverKey = 'AAAAfexbmoo:APA91bE5VzPqQqF_U1CIgYTV2mk_q-SmW6veR4w1pF2IYH6Jw1WoFqsQ8VN7mQcJOqyaAinByslgyvSy8JDABeXCuyn1rNegjk8MTwEFck97uaf1AD9aBFPQdsNVkbFExdKeON6VaYyp';
                $data = [
                    "registration_ids" => $FcmToken,
                    "notification" => [
                        "title" => "Account Deactivated",
                        "body" => "Please contact system administrator for further details",
                    ],
                    "data" => [
                        "notification_type" => 'logout',
                    ],
                ];
                $encodedData = json_encode($data);
                $headers = [
                    'Authorization:key=' . $serverKey,
                    'Content-Type: application/json',
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
                $result = curl_exec($ch);
                if ($result === false) {
                    die('Curl failed: ' . curl_error($ch));
                }
                curl_close($ch);

            }

            return response(['success' => true, 'message' => 'User has been updated successfully']);
        } else {
            return response(['success' => false, 'message' => 'User not Update']);
        }

    }
    public function contact(Request $request)
    {
        if ($request->ajax()) {
            $contact = Contact::with('user')->orderby('id', 'desc');
            return Datatables::of($contact)
                ->addIndexColumn()
                ->addColumn('users', function ($contact) {
                    return $contact->user->name;
                })->make(true);
        }
        return view('admin.users.contact');
    }

    public function contactDelete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $contact = Contact::findOrFail($request->id);
        if ($contact->delete()) {
            return response(['success' => true, 'message' => 'Contact request has been deleted']);
        } else {
            return response(['success' => false, 'message' => 'Contact request not deleted']);
        }
    }

}
