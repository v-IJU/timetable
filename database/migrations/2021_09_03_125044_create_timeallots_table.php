<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeallotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeallots', function (Blueprint $table) {
            $table->id();
            $table->string('Working_days');
            $table->string('working_hours_per_day');
            $table->string('Total_Subjects');
            $table->string('subjects_per_day');
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
        Schema::dropIfExists('timeallots');
    }
}
