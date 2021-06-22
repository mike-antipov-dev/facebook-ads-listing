<?php

use Illuminate\Database\Seeder;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 30; $i++) { 
            DB::table('ads')->insert([
            'id' => $faker->unique()->numberBetween($min = 23843520000000000, $max = 23843520999999999),
            'campaign_id' => 23843520874040608,
            'adset_id' => 23843520874050608,
            'name' => $faker->catchPhrase
        ]);
        }
        
    }
}
