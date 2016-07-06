<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon as Carbon;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 1; $i <= 3; $i++) {
            DB::table('slideshows')->insert([
                'post_id' => 31,
                'image' => 'http://lorempixel.com/535/376/',
                'thumbnail' => 'http://lorempixel.com/95/57/',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
        	]);
        }
            
    }
}
