<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        if (!is_null(Auth::user())) {
            if (Auth::user()->role == 'admin') {
                return redirect('/admin');
            } else {
                return redirect('user/reports');
            }
        }

        return view('index');
    }
}
