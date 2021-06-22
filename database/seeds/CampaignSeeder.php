<?php

use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 20; $i++) { 
            DB::table('campaigns')->insert([
            'id' => $faker->unique()->numberBetween($min = 23843520874040999, $max = 23843520899999999),
            'user_id' => 3,
            'account_id' => 422996148257339,
            'name' => $faker->catchPhrase
        ]);
        }
        
    }
}
