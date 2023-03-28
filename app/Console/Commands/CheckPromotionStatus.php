<?php

namespace App\Console\Commands;

use App\Models\Promotion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckPromotionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promotion:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       //$today = Carbon::now()->format('Y-m-d');
       $today_date =  date('Y-m-d');
       $today = Carbon::parse($today_date)->format('Y-m-d');
       $promotions = Promotion::where('status','active')->get();
        //$promotions_to_be_end = Promotion::where('end_date_time',$today)->get();
        if($promotions->count()>0){
            foreach($promotions as $promotion){

                $p_startDate = Carbon::parse($promotion->start_date_time);
                $p_endtDate =  Carbon::parse($promotion->end_date_time);
                Log::info($promotion);
                if($p_startDate->gt($today) and $p_endtDate->gt($today)){
                    $promotion->is_schedule = false;
                    Log::info($promotion);
                }elseif($p_endtDate->lt($today)){
                    $promotion->is_schedule = false;
                    Log::info($promotion);
                }else{
                    $promotion->is_schedule = true;
                    Log::info($promotion);
                }

                $promotion->save();



                // if($p_startDate->eq($today) and $p_endtDate->eq($today)){
                //     $promotion->is_schedule = true;
                //     Log::info($promotion);

                // }elseif($p_startDate->eq($today) and $p_endtDate->gt($today)){
                //     $promotion->is_schedule = true;
                //     Log::info($promotion);
                // }
                // elseif($p_startDate->gt($today) and $p_endtDate->gt($today)){
                //     $promotion->is_schedule = false;
                //     Log::info($promotion);
                // }

                // elseif($p_startDate->lt($today) and $p_endtDate->eq($today)){
                //     $promotion->is_schedule = true;
                //     Log::info($promotion);
                // }


                // elseif($p_startDate->lt($today) and $p_endtDate->gt($today)){
                //     $promotion->is_schedule = true;
                //     Log::info($promotion);
                // }

                // elseif($p_endtDate->eq($today)){
                //     $promotion->is_schedule = true;
                //     Log::info('Condation 4');
                // }
                // elseif($p_endtDate->lt($today)){
                //     $promotion->is_schedule = false;
                //     Log::info($promotion);
                // }


                // Log::info('Scheduling Now :'.$promotion);
            }
        }else{
            Log::info('No Promotion for Scheduling');
        }

    }
}
