<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Notifications\ResetPasswordNotification;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class  AuthController extends ApiController
{

    public function __construct(UserRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }


    public function login(LoginRequest $request)
    {

        $email = $request->get('email');
        $password = $request->get('password');

        // Check email
        $user = $this->repository->getUserByEmail($email);

        // Check password
        if (!$user || !Hash::check($password, $user->password)) {
            return $this->httpResponse->setJsonResponse([
                'success' => false,
                'errors' => 'Email or Password Invalid'
            ], self::STATUS_UNAUTHORIZED);
        }

        $token = $this->getToken($user->createToken(Hash::make($email . $password))->plainTextToken);
        $user['token'] = $token;

        return $this->httpResponse->setResponse([
            'success' => true,
            'user' => $user,
        ], self::STATUS_OK);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return $this->httpResponse->setResponse([
            'success' => true,
            'message' => 'Logged out'
        ], self::STATUS_OK);
    }

    public function forgetPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $token = Hash::make(Str::random(128));
        $user = $this->repository->getUserByEmail($request->input('email'));
        if ($user && $this->repository->setResetToken($request->input('email'), $token)) {
            $user->notify(new ResetPasswordNotification(['token' => $token]));
            return $this->httpResponse->setResponse([
                'success' => true,
                'token' => $token,
                'message' => 'Sent you an email please check your email.'
            ], self::STATUS_OK);
            /*Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password1111111');
            });*/
        }
        return $this->httpResponse->setJsonResponse([
            'success' => false,
            'errors' => 'Invalid Email'
        ], self::STATUS_UNAUTHORIZED);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->httpResponse->setJsonResponse([
                'success' => false,
                'errors' => $validator->errors()->getMessages()
            ], self::STATUS_UNAUTHORIZED);
        }

        $email = $request->input('email');
        $password = $request->input('password');
        $token = $request->input('token');

        if (!$this->repository->isResetTokenValid($email, $token)) {
            return $this->httpResponse->setJsonResponse([
                'success' => false,
                'errors' => 'Invalid token!'
            ], self::STATUS_UNAUTHORIZED);
        }
        $this->repository->updateUserPasswordByEmailID($email, $password);
        $this->repository->deleteResetPasswordTokenByEmailID($email);
        return $this->httpResponse->setResponse([
            'success' => true,
            'message' => 'Your password has been changed!'
        ], self::STATUS_OK);
    }

}
