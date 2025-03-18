<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPersonMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblCategoryPersonMap', function (Blueprint $table) {
            $table->id();
            $table->string('fldIdPersonDetail',255);
            $table->string('fldIdCategory',255);
            $table->string('fldDateCreated',255);
            $table->string('fldCreatedBy',255);
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
        Schema::dropIfExists('tblCategoryPersonMap');
    }
}
