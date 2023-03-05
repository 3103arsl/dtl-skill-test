<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository {

    const RESET_PASSWORD_TABLE_NAME = 'password_resets';

    public function __construct() {
        $this->model = new User();
    }

    public function getStaff () {
        return $this->model
            ->where(function($query) {
                    $query->whereIn('role', $this->getStaffRole());
            })
            ->get();
    }

    public function getUserByEmail($email) {
        return $this->model::where('email', $email)->first();
    }

    public function setResetToken($email, $token) {
        return DB::table(self::RESET_PASSWORD_TABLE_NAME)->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }

    public function isResetTokenValid($email, $token) {
        $user = DB::table(self::RESET_PASSWORD_TABLE_NAME)->where([
            'email' => $email,
            'token' => $token
        ])->first();
        return ($user) ? true : false;
    }

    public function deleteResetPasswordTokenByEmailID($email) {
        return DB::table(self::RESET_PASSWORD_TABLE_NAME)->where(['email'=> $email])->delete();
    }

    public function updateUserPasswordByEmailID ($email, $password) {
        return $this->model::where('email', $email)->update(['password' => $password]);
    }
}
