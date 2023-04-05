<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{

    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->timestamps();
        });

        DB::table('services')->insert([
            [
                'name' => 'WiFi',
                'slug' => 'WiFi',
            ],
            [
                'name' => 'Car Spot',
                'slug' => 'Car Spot',
            ],
            [
                'name' => 'Pool',
                'slug' => 'Pool',
            ],
            [
                'name' => 'Sauna',
                'slug' => 'Sauna',
            ],
            [
                'name' => 'Porter',
                'slug' => 'Porter',
            ],
            [
                'name' => 'Concierge',
                'slug' => 'Concierge',
            ],
            [
                'name' => 'Smoking',
                'slug' => 'Smoking',
            ],
            [
                'name' => 'Pets',
                'slug' => 'Pets',
            ],
            [
                'name' => 'Air Condtioning',
                'slug' => 'Air Condtioning',
            ],
            [
                'name' => 'Laundry Service',
                'slug' => 'Laundry Service',
            ],
            [
                'name' => 'Breakfast Service',
                'slug' => 'Breakfast Service',
            ],
            [
                'name' => 'Tv',
                'slug' => 'Tv',
            ],
            [
                'name' => 'Hair Dryer',
                'slug' => 'Hair Dryer',
            ],
            [
                'name' => 'Workspace',
                'slug' => 'Workspace',
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}
