<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjecttablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjecttables', function (Blueprint $table) {
            $table->id();
            $table->string('subject_name');
            $table->string('subject_hr');
            $table->integer('status')->default(1)->comment('-1=>trash,0=>disable,1=>active');

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
        Schema::dropIfExists('subjecttables');
    }
}
