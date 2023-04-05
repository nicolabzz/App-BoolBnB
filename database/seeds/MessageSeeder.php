<?php

use App\Apartment;
use App\Message;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $apartment = Apartment::all('id')->all();

        for ($i = 0; $i < 100; $i++) {
            $message = Message::create([
                'apartment_id' => $faker->randomElement($apartment)->id,
                'message' => $faker->text(100),
                'date'    => $faker->dateTime(),
            ]);
        }
    }
}

