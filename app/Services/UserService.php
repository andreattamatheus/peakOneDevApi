<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Get all users.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUserToken(string $email)
    {
        $user = User::query()->where('email', $email)->firstOrFail();
        return  $user->createToken('auth_token')->plainTextToken;
    }


    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $request)
    {
        $user = new User([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        $user = DB::transaction(function () use ($user) {
            $user->save();
            return $user;
        });

        return $user;
    }
}
