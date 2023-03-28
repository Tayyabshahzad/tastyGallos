<?php

namespace Database\Seeders;

use App\Models\Faq;


use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faq = new Faq;
        $faq->question = "Ques1";
        $faq->answer = "Ans2";
        $faq->position = 1;
        $faq->status = "active";
        $faq->save();


        $faq = new Faq;
        $faq->question = "Ques2";
        $faq->answer = "Ans2";
        $faq->position = 1;
        $faq->status = "active";
        $faq->save();



        $faq = new Faq;
        $faq->question = "Ques3";
        $faq->answer = "Ans3";
        $faq->position = 1;
        $faq->status = "active";
        $faq->save();



        $faq = new Faq;
        $faq->question = "Ques4";
        $faq->answer = "Ans4";
        $faq->position = 1;
        $faq->status = "active";
        $faq->save();
    }
}
