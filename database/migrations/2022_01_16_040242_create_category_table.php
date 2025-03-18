<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblCategory', function (Blueprint $table) {
            $table->id();
            $table->string('fldCategoryType', 255);
            $table->string('fldCreatedDate', 255);
            $table->string('fldCreatedBy', 255);
            $table->string('fldCategorySlug', 255)->nullable();
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
        Schema::dropIfExists('tblCategory');
    }
}
