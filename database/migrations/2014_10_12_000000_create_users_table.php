<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->date('birthdate');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name'      => 'Luca',
                'surname'   => 'Booleaner',
                'birthdate' => '2001-01-01',
                'email'     => 'luca@gmail.com',
                'password'  => Hash::make('luca'),
            ],
            [
                'name'       => 'Andrea',
                'surname'    => 'Booleaner',
                'birthdate'  => '2001-01-01',
                'email'      => 'andrea@gmail.com',
                'password'   => Hash::make('andrea'),
            ],
            [
                'name'      => 'Nicola',
                'surname'   => 'Booleaner',
                'birthdate' => '2001-01-01',
                'email'     => 'nicola@gmail.com',
                'password'  => Hash::make('nicola'),
            ],
            [
                'name'      => 'Giulio',
                'surname'   => 'Booleaner',
                'birthdate' => '2001-01-01',
                'email'     => 'giulio@gmail.com',
                'password'  => Hash::make('giulio'),
            ],
            [
                'name'      => 'Simone',
                'surname'   => 'Booleaner',
                'birthdate' => '2001-01-01',
                'email'     => 'simone@gmail.com',
                'password'  => Hash::make('simone'),
            ],

        ]);
    }



    public function down()
    {
        Schema::dropIfExists('users');
    }
}
