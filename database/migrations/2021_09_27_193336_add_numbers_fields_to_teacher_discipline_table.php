<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumbersFieldsToTeacherDisciplineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_discipline', function (Blueprint $table) {
            $table->unsignedBigInteger('number_of_practices')->default(0)->after('discipline_id');
            $table->unsignedBigInteger('number_of_labs')->default(0)->after('number_of_practices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_discipline', function (Blueprint $table) {
            $table->dropColumn('number_of_practices');
            $table->dropColumn('number_of_labs');
        });
    }
}
