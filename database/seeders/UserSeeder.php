<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Ahmad Ayaz Noor";
        $user->username = "ahmadayaz";
        $user->email = "ahmadayaznoor@gmail.com";
        $user->password = bcrypt("Google@123");
        $user->dob = "1992-08-28";
        $user->gender = "male";
        $user->registered_type = "email";
        $user->facebook_id = "";
        $user->google_id = "";
        $user->save();
        $user->assignRole('admin');

        // $user = new User;
        // $user->name = "Tasty Gallos Kagiso Mall";
        // $user->username = "Tasty-Gallos-Kagiso-Mall";
        // $user->email = "tastygalloskagisomall@gmail.com";
        // $user->password = bcrypt("Google@123");
        // $user->dob = "1990-01-18";
        // $user->gender = "male";
        // $user->registered_type = "email";
        // $user->facebook_id = "";
        // $user->google_id = "";
        // $user->save();
        // $user->assignRole('franchise');


        // $user = new User;
        // $user->name = "Tasty Gallos Test account";
        // $user->username = "Tasty Gallos Test account";
        // $user->email = "tastygallosalexmall@gmail.com";
        // $user->password = bcrypt("Google@123");
        // $user->dob = "1990-01-18";
        // $user->gender = "male";
        // $user->registered_type = "email";
        // $user->facebook_id = "";
        // $user->google_id = "";
        // $user->save();
        // $user->assignRole('franchise');




        // $user = new User;
        // $user->name = "Test Customer";
        // $user->username = "Tasty-Gallos-Alex-Mall";
        // $user->email = "amna.101.id@gmail.com";
        // $user->password = bcrypt("Google@123");
        // $user->dob = "1990-01-18";
        // $user->gender = "male";
        // $user->registered_type = "email";
        // $user->facebook_id = "";
        // $user->google_id = "";
        // $user->save();
        // $user->assignRole('customer');




    }
}
