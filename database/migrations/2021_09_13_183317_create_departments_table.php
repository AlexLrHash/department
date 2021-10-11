<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\Enum\Api\DefaultUrlEnum;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index();
            $table->unsignedBigInteger('manager_id');
            $table->longText('description')->nullable()->default(null);
            $table->string('background')->default(DefaultUrlEnum::DEPARTMENT_DEFAULT_BACKGROUND_URL);
            $table->integer('second_id');
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
        Schema::dropIfExists('departments');
    }
}
