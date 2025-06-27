<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginAs($id)
    {

       $user = User::query()->where('id', $id)->first();

       auth()->login($user);

       return redirect('/shop');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/shop');
    }
}
