<?php

use App\View;
use App\Apartment;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{

    public function run(Faker $faker)
    {
        $apartment = Apartment::all('id')->all();

        for($i = 0 ; $i < 100 ; $i++) {
            $view = View::create([
                'apartment_id' => $faker->randomElement($apartment)->id,
                'IP'   => $faker->localIpv4(),
                'date' => $faker->dateTime(),
            ]);
        }
    }
}
