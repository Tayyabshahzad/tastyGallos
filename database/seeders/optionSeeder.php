<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class optionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            'option_name' => 'login_screen_content',
            'option_value' => 'Text needs to update',
        ]);
        DB::table('options')->insert([
            'option_name' => 'commission',
            'option_value' => '5',
        ]);
        DB::table('options')->insert([
            'option_name' => 'paygate_id',
            'option_value' => '10011072130',
        ]);
        DB::table('options')->insert([
            'option_name' => 'reference_id',
            'option_value' => 'pgtest_123456789',
        ]);
        DB::table('options')->insert([
            'option_name' => 'cms_firebase_server_key',
            'option_value' => 'AAAAMJTS_hs:APA91bG2OvAw5DUMtJshyqVLeAlX-tA72JDC-A4eZfFyK87GPUynTnS1FxnnCJHA4AsFWTJmnNUs8wBHbMm1MTc6buZq4R2ErypavRArnvGCMBVXbL-FHidmi7aIkMoh14ESr-3RUykh',
        ]);
        DB::table('options')->insert([
            'option_name' => 'app_firebase_server_key',
            'option_value' => 'AAAAfexbmoo:APA91bE5VzPqQqF_U1CIgYTV2mk_q-SmW6veR4w1pF2IYH6Jw1WoFqsQ8VN7mQcJOqyaAinByslgyvSy8JDABeXCuyn1rNegjk8MTwEFck97uaf1AD9aBFPQdsNVkbFExdKeON6VaYyp',
        ]);

        DB::table('options')->insert([
            'option_name' => 'firebase_api_key',
            'option_value' => 'AIzaSyDwj3nPjSTAxdO96FABpwhGWVjlQxvIGjU',
        ]);

        DB::table('options')->insert([
            'option_name' => 'database_url',
            'option_value' => 'https://notificationrepo.firebaseio.com',
        ]);

        DB::table('options')->insert([
            'option_name' => 'auth_domain',
            'option_value' => 'notificationrepo.firebaseapp.com',
        ]);
        DB::table('options')->insert([
            'option_name' => 'project_id',
            'option_value' => 'notificationrepo',
        ]);
        DB::table('options')->insert([
            'option_name' => 'storage_bucket',
            'option_value' => 'notificationrepo.appspot.com',
        ]);
        DB::table('options')->insert([
            'option_name' => 'messaging_sender_id',
            'option_value' => '208655285787',
        ]);

        DB::table('options')->insert([
            'option_name' => 'app_id',
            'option_value' => '1:208655285787:web:33d5812aa325a6cfdbc2be',
        ]);
        DB::table('options')->insert([
            'option_name' => 'measurement_id',
            'option_value' => 'G-TJFJWJMVEN',
        ]);
    }
}
