<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if ($this->user) {
                if ($this->user->status !== 'Ожидает модерации' && $this->user->status !== 'Заблокирован') {
                    return redirect('/home');
                }
            }
            return $next($request);
        });
    }

    public function moderate()
    {
        return view('moderate');
    }

    public function blocked()
    {
        return view('blocked');
    }
}
