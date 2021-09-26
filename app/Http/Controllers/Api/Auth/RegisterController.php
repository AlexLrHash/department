<?php

namespace App\Http\Controllers\Api\Auth;

use App\Classes\Enum\Api\User\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\VerifyEmailRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Jobs\SendEmailVerificationJob;
use App\Jobs\SendVerificationTokenEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Register User
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $userEmail = $request->get('email');

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $userEmail,
            'password' => Hash::make($request->get('password')),
            'is_consent_privacy_policy' => $request->get('is_consent_privacy_policy', 0),
            'is_consent_terms_of_use' => $request->get('is_consent_terms_of_use', 0),
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
     * @param $verify_token
     * @return UserResource
     */
    public function verifyEmail(VerifyEmailRequest $request)
    {
        $user = Auth::user();

        if ($this->checkUserVerifyToken($user, $request->get('verify_token'))) {
            $user->verify_token = null;
            $user->email_verified_at = Carbon::now();
            $user->status = UserStatusEnum::ACTIVE;
            $user->save();
        } else {
            abort(401, 'Неверный верификацонный код');
        }

        return UserResource::make($user);
    }

    /**
     * Повторная отправка email
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function resendEmail()
    {
        $user = Auth::user();
        $user->verify_token = Str::random(24);
        $user->save();

        $job = new SendEmailVerificationJob($user->verify_token, $user->email);
        $this->dispatch($job);

        return response([
            'status' => 'success',
            'data'   => 'На почту'. $user->email . 'отправлено повторно сообщение для подтверждения'
        ]);
    }

    /**
     * Проверка токена пользователя
     *
     * @param User $user
     * @param $verifyToken
     * @return bool
     */
    public function checkUserVerifyToken(User $user, $verifyToken)
    {
        return $user->verify_token == $verifyToken;
    }

    /**
     * TODO запомнить меня
     */

    /**
     * TODO авторизация по соц сетям
     */

    /**
     * TODO каптча
     */
}
