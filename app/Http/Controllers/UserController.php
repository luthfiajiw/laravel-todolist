<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function login(): Response
    {
        return response()
            ->view('user.login', [
                "title" => "Login"
            ]);
    }

    public function onLogin(Request $request)
    {
        $username = $request->input('user');
        $password = $request->input('password');

        if (empty($username) || empty($password)) {
            return response()->view('user.login', [
                "title" => "Login",
                "error" => "Username and password is required"
            ]);
        }

        if ($this->userService->login($username, $password)) {
            $request->session()->put("user", $username);
            return redirect("/");
        }

        return response()->view('user.login', [
            "title" => "Login",
            "error" => "Username or password is invalid"
        ]);
    }

    public function onLogout(Request $request): RedirectResponse
    {
        $request->session()->forget('user');
        return redirect('/login');
    }
}
