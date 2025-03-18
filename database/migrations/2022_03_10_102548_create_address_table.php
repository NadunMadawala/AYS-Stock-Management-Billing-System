<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblAddress', function (Blueprint $table) {
            $table->id();
            $table->string('fldAddLine1',255)->nullable();
            $table->string('fldAddLine2',255)->nullable();
            $table->string('fldAddLine3',255)->nullable();
            $table->string('fldAddLine4',255)->nullable();
            $table->string('fldAddLine5',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
