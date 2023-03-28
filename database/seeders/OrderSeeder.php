<?php

namespace Database\Seeders;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//         $order = new Order;
//         $order->user_id = 4;
//         $order->franchise_id = 1;
//         $order->order_number = 1001;
//         $order->time_ago = Carbon::now();
//         $order->type = 'delivery';
//         $order->sub_total = 200;
//         $order->extra = 150;
//         $order->total = 350;
//         $order->admin_commission = 2;
//         $order->status = 'order';
//         $order->address = '{
//     "lat": 33.7181584,
//     "lng": 73.071358,
//     "address": "group floor, Blue Area, Islamabad",
//     "building_name": "cdfb",
//     "appartment_floor_number": "ddff"
// }';
//         $order->created_at = Carbon::now();
//         $order->order_date = Carbon::now();
//         $order->warning =  Carbon::now();
//         $order->danger = Carbon::now();
//         $order->did_pay = true;
//         $order->save();
//         $order->danger = Carbon::parse($order->created_at)->addMinutes(30);
//         $order->save();

//         $order = new Order;
//         $order->user_id = 4;
//         $order->franchise_id = 1;
//         $order->order_number = 1002;
//         $order->time_ago = Carbon::now()->addDays(2);
//         $order->type = 'delivery';
//         $order->sub_total = 300;
//         $order->extra = 50;
//         $order->total = 350;
//         $order->admin_commission = 2;
//         $order->status = 'order';

//         $order->created_at = Carbon::now()->addDays(2);
//         $order->order_date = Carbon::now()->addDays(2);
//         $order->warning =  Carbon::now();
//         $order->danger = Carbon::now();
//         $order->address = '{
//     "lat": 33.7181584,
//     "lng": 73.071358,
//     "address": "group floor, Blue Area, Islamabad",
//     "building_name": "cdfb",
//     "appartment_floor_number": "ddff"
// }';
//         $order->save();
//         $order->danger = Carbon::parse($order->created_at)->addMinutes(30);
//         $order->save();



//         $order = new Order;
//         $order->user_id = 3;
//         $order->franchise_id = 2;
//         $order->order_number = 1003;
//         $order->time_ago = Carbon::now()->addDays(3);
//         $order->type = 'delivery';
//         $order->sub_total = 550;
//         $order->extra = 100;
//         $order->total = 650;
//         $order->admin_commission = 2;
//         $order->status = 'order';
//         $order->address = '{
//     "lat": 33.7181584,
//     "lng": 73.071358,
//     "address": "group floor, Blue Area, Islamabad",
//     "building_name": "cdfb",
//     "appartment_floor_number": "ddff"
// }';
//         $order->created_at = Carbon::now()->addDays(3);
//         $order->order_date = Carbon::now()->addDays(3);
//         $order->warning =  Carbon::now();
//         $order->danger = Carbon::now();

//         $order->save();
//         $order->danger = Carbon::parse($order->created_at)->addMinutes(30);
//         $order->save();

//         $order = new Order;
//         $order->user_id = 3;
//         $order->franchise_id = 2;
//         $order->order_number = 1004;
//         $order->time_ago = Carbon::now()->addDays(4);
//         $order->type = 'delivery';
//         $order->sub_total = 1050;
//         $order->extra = 100;
//         $order->total = 1150;
//         $order->admin_commission = 2;
//         $order->status = 'order';
//         $order->address = '{
//     "lat": 33.7181584,
//     "lng": 73.071358,
//     "address": "group floor, Blue Area, Islamabad",
//     "building_name": "cdfb",
//     "appartment_floor_number": "ddff"
// }';
//         $order->created_at = Carbon::now()->addDays(4);
//         $order->order_date = Carbon::now()->addDays(4);
//         $order->warning =  Carbon::now();
//         $order->danger = Carbon::now();
//         $order->save();
//         $order->danger = Carbon::parse($order->created_at)->addMinutes(30);
//         $order->save();


        // $order = new Order;
        // $order->user_id = 7;
        // $order->franchise_id = 2;
        // $order->order_number = 1004;
        // $order->time_ago =Carbon::now()->addDays(3);
        // $order->type = 'pickup';
        // $order->total = 70;
        // $order->admin_commission = 7;
        // $order->stdadasdasdasddatus = 'pending';
        // $order->created_at =  Carbon::now()->addDays(3);
        // $order->save();

        // $order = new Order;
        // $order->user_id = 8;
        // $order->franchise_id = 1;
        // $order->order_number = 1005;
        // $order->time_ago =Carbon::now()->addDays(3);
        // $order->type = 'delivery';
        // $order->total = 140;
        // $order->admin_commission = 6;
        // $order->status = 'completed';
        // $order->created_at =  Carbon::now()->addDays(4);
        // $order->save();

        // $order = new Order;
        // $order->user_id = 8;
        // $order->franchise_id = 1;
        // $order->order_number = 1006;
        // $order->time_ago =Carbon::now()->addDay();
        // $order->type = 'delivery';
        // $order->total = 70;
        // $order->admin_commission = 6;
        // $order->status = 'processing';
        // $order->created_at =  Carbon::now()->addDays(5);
        // $order->save();

        // $order = new Order;
        // $order->user_id = 8;
        // $order->franchise_id = 1;
        // $order->order_number = 1007;
        // $order->time_ago =Carbon::now()->addDays(2);
        // $order->type = 'delivery';
        // $order->total = 70;
        // $order->admin_commission = 6;
        // $order->status = 'processing';
        // $order->created_at =  Carbon::now()->addDays(6);
        // $order->save();

        // $order = new Order;
        // $order->user_id = 8;
        // $order->franchise_id = 1;
        // $order->order_number = 1008;
        // $order->time_ago =Carbon::now()->addDays(2);
        // $order->type = 'delivery';
        // $order->total = 70;
        // $order->admin_commission = 6;
        // $order->created_at =  Carbon::now()->addDays(6);
        // $order->status = 'processing';
        // $order->save();
    }
}
