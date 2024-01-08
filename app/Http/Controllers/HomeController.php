<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homePage(Request $request)
    {
        if ($request->session()->exists('user')) {
            return response()->view('home');
        } else {
            return redirect('/login');
        }
    }
}
