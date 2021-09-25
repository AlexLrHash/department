<?php

namespace App\Http\Controllers\Api\Auth;

use App\Classes\Enum\Api\User\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Jobs\SendEmailVerificationJob;
use App\Jobs\SendVerificationTokenEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Register User
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * #TODO подтверждение email
     */
    public function register(RegisterRequest $request)
    {
        $userEmail = $request->get('email');

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $userEmail,
            'password' => Hash::make($request->get('password')),
            'verify_token' => Str::random(24)
        ]);

        $jwtToken = $user->createToken('token')->plainTextToken;

        $job = new SendEmailVerificationJob($user->verify_token, $userEmail);
        $this->dispatch($job);
//        Mail::to($userEmail)->send(new VerifyUserEmail($user->verify_token));

        return response([
            'status' => 'success',
            'token' => $jwtToken,
            'data'   => 'На почту ' . $userEmail . ' отправлено сообщение для подтверждения',
        ]);
    }

    /**
     * Верификация по email
     *
     * @param $verificationToken
     * @return UserResource
     */
    public function verifyEmail($verificationToken)
    {
        $user = User::where('verify_token', $verificationToken)->first();

        if ($user) {
            $user->verify_token = null;
            $user->email_verified_at = Carbon::now();
            $user->status = UserStatusEnum::ACTIVE;
            $user->save();
        } else {
            abort(401, 'Неверный верификацонный номер');
        }

        return UserResource::make($user);
    }

    public function resendEmail()
    {

    }

    /**
     * TODO запомнить меня
     */

    /**
     * TODO авторизация по соц сетям
     */
}
