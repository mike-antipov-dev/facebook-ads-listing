<?php

use Illuminate\Database\Seeder;

class AdSetSeeder extends Seeder
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
            DB::table('adsets')->insert([
            'id' => $faker->unique()->numberBetween($min = 23843520873000608, $max = 23843520873999999),
            'campaign_id' => 23843520874040608,
            'name' => $faker->catchPhrase
        ]);
        }
        
    }
}
