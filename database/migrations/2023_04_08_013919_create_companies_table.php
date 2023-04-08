<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('street_address');
            $table->string('representative_name');
            $table->timestamps();
        });

        \DB::table('companies')->insert([
            'id' => 1,
            'company_name' => 'カルビー',
            'street_address' => '',
            'representative_name' => '',
        ],

        [
            'id' => 2,
            'company_name' => '明治',
            'street_address' => '',
            'representative_name' => '',
        ],

        [
            'id' => 3,
            'company_name' => '森永',
            'street_address' => '',
            'representative_name' => '',
        ],
    
    );
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
