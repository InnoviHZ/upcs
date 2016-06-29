<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class HomeController extends Controller
{

    public function index(User $user, Request $request)
    {
        $viewData = [
            'currentView' => 'home'
        ];

        if($user->isLoggedIn() || $user->isLoggedInViaRemember()){
            return redirect(route('dashboard'));
        }

        return view('home')->with($viewData);
    }

    public function authenticate(LoginRequest $request, User $user)
    {
        if($user->authenticateUser($request->all())){
            return redirect(route('dashboard'));
        } else {
            return back()->withInput()->with([
                'notification_type' => 'danger',
                'notification_message' => 'Login Failed, check your credentials!'
            ]);
        }
    }

    public function logout(User $user)
    {
        $user->logoutUser();
        return redirect(route('home'));
    }
}
