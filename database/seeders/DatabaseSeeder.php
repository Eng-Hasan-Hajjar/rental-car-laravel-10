<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Car;
use App\Models\Fleet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
             \App\Models\User::create([
          'name' => 'Test User',
          'email' => 'test@example.com',
          'password'=>'123456789',
          'role'=>'admin',
        ]);
        \App\Models\User::create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password'=>'123456789',
            'role'=>'visitor',
          ]);
          \App\Models\User::create([
            'name' => 'Test User 3',
            'email' => 'test3@example.com',
            'password'=>'123456789',
          ]);



          \App\Models\Car::create([
                'brand' => "bmw",
                'model' => "2016",
                'year' => "2010",
                'color' => "red",
                'seats' => "4",
                'daily_rate' => '1',
                'status' => 'available',
                'description' => '',
                'image' => '',
                'fleet_id' => '1',

          ]);
          \App\Models\Fleet::create([
            'name' => '',
            'location' => '',
            'description' => '',

          ]);
         
          \App\Models\Rating::create([
            'user_id' => '1',
            'car_id' => '1',
            'rating' => '1',
            'review' =>'2',

          ]);

          \App\Models\Maintenance::create([
            'car_id' => '1',
            'description' => '',
            'date' => '',
            'cost' => '',

          ]);







    }
}
