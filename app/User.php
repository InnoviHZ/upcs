<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'role_id', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function authenticateUser($data)
    {
        $remember = isset($data['remember']) ? true : false;

        return Auth::attempt([
                'username' => $data['username'],
                'password' => $data['password']
            ], $remember);
    }

    public function changeAdminPassword($data)
    {
        $user = Auth::user();
        return $this->whereId($user->id)->update(['password' => Hash::make($data['password'])]);
    }

    public function adminUsersList()
    {
        return $this->orderBy('created_at', 'desc')->get();
    }

    public function newAdminUser($data)
    {
        return $this->create([
            'username' => Str::lower($data['username']),
            'password' => Hash::make($data['password']),
            'firstname' => Str::title($data['firstname']),
            'lastname' => Str::title($data['lastname']),
            'email' => Str::lower($data['email']),
            'role_id' => $data['role_id'],
        ]);
    }

    public function editAdminUser($data)
    {
        $userId = $data['user_id'];
        $updateData = [
            'firstname' => Str::title($data['firstname']),
            'lastname' => Str::title($data['lastname']),
            'email' => Str::lower($data['email']),
            'role_id' => $data['role_id'],
        ];
        if(!empty($data['password'])){
            $updateData['password'] = Hash::make($data['password']);
        }
        return $this->whereId($userId)->update($updateData);
    }

    public function adminUserDetail($id)
    {
        return $this->whereId($id)->first();
    }

    public function deleteAdminUser($id)
    {
        return $this->whereId($id)->where('role_id', 1)->delete();
    }

    public function isLoggedInViaRemember()
    {
        return Auth::viaRemember();
    }

    public function isLoggedIn()
    {
        return Auth::check();
    }

    public function logoutUser()
    {
        session()->flush();
        return Auth::logout();
    }
}
