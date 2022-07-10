<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create()
    {
        return view('users.register');
    }

    public function store( Request $request ) {
        // Validate the request...
        // $user = new User;
        // $user->name = request('name');
        // $user->email = request('email');
        // $user->password = bcrypt(request('password'));
        // $user->save();
        // return redirect('/')->with('message', 'Thanks for registering!');


        // $this->validate(request(), [
        //     'name' => 'required|max:255',
        //     'email' => 'required|email|max:255|unique:users',
        //     'password' => 'required|confirmed|min:6',
        // ]);

        $formFields = $request->validate([
            'name' => ['required','min:3'],
            'email' => ['required','email',Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        //login
        auth()->login($user);

        return redirect('/')->with('message', 'Thanks for registering! You are now logged in.');

    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth/login')->with('message', 'You have logged out!');
    }


    public function login(){
        return view('users.login');
    }

    public function authenticate(Request $request){

        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
        }
        return back()->withErrors(['email' => 'Invalid credentials!', 'password' => 'Invalid credentials!']);

        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        // if(auth()->attempt($credentials)){
        //     return redirect('/')->with('message', 'You are now logged in!');
        // }
        // return redirect('/login')->with('error', 'Invalid credentials!');
    }
}
