<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(ApartmentSeeder::class);
        $this->call(ViewSeeder::class);
        $this->call(MessageSeeder::class);
    }
}
