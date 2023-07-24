<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request){
        $inputs = $request -> validate([
            'name' => ['required', 'min:3'],
            'email'=> ['required', 'email'],
            'password'=> ['required', 'min:3']
        ]);

        $inputs['password'] = bcrypt($inputs['password']);
        $user = User::create($inputs);

        return redirect();
    }
}
