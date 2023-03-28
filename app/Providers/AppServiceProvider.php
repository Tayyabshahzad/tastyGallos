<?php

namespace App\Providers;

use App\Models\Refund;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $refundCount = Refund::where('status','pending')->count();
        $notifications = DB::table('notifications')->get();

        $data = array(
            'totalRefund' => $refundCount,
            'notifications' => $notifications,
        );


        View::share($data);
    }
}
