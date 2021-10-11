<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Classes\Enum\Api\User\UserStatusEnum;
use App\Classes\Enum\Api\DefaultUrlEnum;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index();
            $table->string('email')->unique()->nullable()->default(null)->index();
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->string('verify_token')->nullable()->default(null);
            $table->string('password');
            $table->string('phone')->nullable()->default(null)->index();
            $table->string('avatar')->default(DefaultUrlEnum::USER_DEFAULT_AVATAR_URL);
            $table->string('status')->default(UserStatusEnum::NEW);
            $table->string('role')->default(UserRoleEnum::USER);
            $table->integer('second_id');
            $table->boolean('is_consent_terms_of_use')->default(false);
            $table->boolean('is_consent_privacy_policy')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
