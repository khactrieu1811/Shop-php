<?php

namespace App\Http\Controllers;

use App\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function loginAdmin(){
        // mã hóa dd(bcrypt(' '))

        if(auth()->check()){
            return redirect()->to('home');
        }
        return view('login');
    }
    public function home(){
        // mã hóa dd(bcrypt(' '))
        if (auth()->check()) {
            return view('home');
        } else {
            return redirect()->to('login');
        }
    }
    public function postLoginAdmin(Request $request){
        $remember = $request->has('remember_me') ? true : false;

        if(Auth::attempt([
            'email'=> $request->email,
            'password'=>$request->password
        ], $remember)){
            return redirect()->to('home');
        }else {
            return redirect()->back()->withErrors(['Login failed']);
        }
    }
    public function registerAdmin()
    {
        return view('register');
    }

    public function registerUser(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
            $user = User::create($data);
        if($user){
            return redirect()->to('login');
        }else {
            return redirect()->back()->withErrors(['Register failed']);
        }
    }
    public function logoutAdmin(){
        return view('login');
    }
}
