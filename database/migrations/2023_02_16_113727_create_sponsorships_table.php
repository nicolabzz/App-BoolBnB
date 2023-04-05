<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorshipsTable extends Migration
{
    public function up()
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->id();
            $table->string('type', 100);
            $table->float('price',3 ,2);
            $table->unsignedTinyInteger('sponsor_time');
            $table->timestamps();
        });

        DB::table('sponsorships')->insert([
            [
                'type'         => 'Bronze Sponsorship',
                'price'        => 2.99,
                'sponsor_time' => 24,
            ],
            [
                'type'         => 'Silver Sponsorship',
                'price'        => 5.99,
                'sponsor_time' => 72,
            ],
            [
                'type'         => 'Gold Sponsorship',
                'price'        => 9.99,
                'sponsor_time' => 144,
            ]
        ]);
    }


    public function down()
    {
        Schema::dropIfExists('sponsorships');
    }
}
