<?php

namespace Database\Seeders;

use App\Models\Home;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory()->create();
        // User::create([
        //     'name' => 'SuperAdmin',
        //     'email' => 'superadmin@followme.com',
        //     'password' => Hash::make ('password'),
        // ]);
				// \App\Models\User::firstOrCreate([
				// 	'email' => 'superadmin@followme.com',
				// ], [
				// 		'name' => 'SuperAdmin',
				// 		'password' => bcrypt('your_password_here'),
				// ]);

        // $settingInit =  [
        //     ['setting_keys' =>'facebook',
        //     'setting_values' => null],
        // ];
        // Setting::insert($settingInit);

        $homeInit =  [
            ['home_keys' =>'title',
            'home_values' => null,
            'created_at' => now(),
            'updated_at' => now()],
						['home_keys' =>'recommend',
            'home_values' => null,
            'created_at' => now(),
            'updated_at' => now()],
        ];
        Home::insert($homeInit);
    }
}
