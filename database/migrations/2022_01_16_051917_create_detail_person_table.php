<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblDetailPerson', function (Blueprint $table) {
            $table->id();
            $table->string('fldFirstName', 255)->nullable();
            $table->string('fldLastName', 255)->nullable();
            $table->string('fldAddLine1', 255)->nullable();
            $table->string('fldAddLine2', 255)->nullable();
            $table->string('fldAddLine3', 255)->nullable();
            $table->string('fldAddLine4', 255)->nullable();
            $table->string('fldNicNo', 255)->nullable();
            $table->string('fldDob', 255)->nullable();
            $table->string('fldTelephoneNo', 255)->nullable();
            $table->string('fldIdWard', 255);
            $table->string('fldCreatedDate', 255)->nullable();
            $table->string('fldCreatedBy', 255)->nullable();
            $table->string('fldEmail', 255)->nullable();
            $table->string('fldFirstAdditionalData', 255)->nullable();
            $table->string('fldSecondAdditionalData', 255)->nullable();
            $table->string('fldThirdAdditionalData', 255)->nullable();
            $table->string('fldFourthAdditionalData', 255)->nullable();
            $table->string('fldFifthAdditionalData', 255)->nullable();
            $table->string('fldsixthAdditionalData', 255)->nullable();
            $table->string('fldseventhAdditionalData', 255)->nullable();
            $table->string('fldEighthAdditionalData', 255)->nullable();
            $table->string('fldNinthAdditionalData', 255)->nullable();
            $table->string('fldTenthAdditionalData', 255)->nullable();
            $table->string('fldFirstAdditionalField', 255)->nullable();
            $table->string('fldSecondAdditionalField', 255)->nullable();
            $table->string('fldThirdAdditionalField', 255)->nullable();
            $table->string('fldFourthAdditionalField', 255)->nullable();
            $table->string('fldFifthAdditionalField', 255)->nullable();
            $table->string('fldsixthAdditionalField', 255)->nullable();
            $table->string('fldseventhAdditionalField', 255)->nullable();
            $table->string('fldEighthAdditionalField', 255)->nullable();
            $table->string('fldNinthAdditionalField', 255)->nullable();
            $table->string('fldTenthAdditionalField', 255)->nullable();
            $table->string('fldDeleteStatus', 255)->nullable();
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
        Schema::dropIfExists('tblDetailPerson');
    }
}
