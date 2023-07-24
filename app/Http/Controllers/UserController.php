<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request){
        $inputs = $request -> validate([
            'name' => ['required', 'min:3', Rule::unique('users','name')],
            'email'=> ['required', 'email', Rule::unique('users', 'email')],
            'password'=> ['required', 'min:3']
        ]);

        $inputs['password'] = bcrypt($inputs['password']);
        $user = User::create($inputs);
        auth()->login($user);

        return redirect()->route('todo.index');
    }

    public function login(Request $request){
        $inputs = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if(auth()->attempt(['name'=> $inputs['loginname'],'password' => $inputs['loginpassword']])){
            $request->session()->regenerate();
        }
        return redirect()->route('todo.index');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
