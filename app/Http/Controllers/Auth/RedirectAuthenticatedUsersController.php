<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function redirectToHome(){
        switch (auth()->user()->role) {
            case 'admin':
                return redirect()->route('testAdmin');
                break;
            case 'user':
                return redirect()->route('userDashboard');
                break;
            case 'guest':
                return redirect()->route('testGuest');
                break;
            default:
                return auth()->logout();
                break;
        }
    }
}
