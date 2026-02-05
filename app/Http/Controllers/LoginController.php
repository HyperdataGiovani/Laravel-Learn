<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login_proses(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            return redirect()->route('admin.index');
        } else{
            return redirect()->route('auth.login')->with('failed', 'Mungkin email dan password yang kamu masukkan salah');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('auth.login')->with('success', 'Kamu berhasil logout');
    }

    public function register(){
        return view('register');
    }
    public function register_proses(Request $request){
    try{
        $request->validate( [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $data['username'] = $request->username;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['email_verified_at'] = now();
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = Str::random(10);

        User::create($data);
        
        return redirect()->route('auth.login')->with('success', 'Selamat kamu sudah berhasil membuat akun');
    } catch(Exception $e){
        return redirect()->route('auth.register')->with('failed', 'Maaf coba ulangi lagi');
    }
    }
}
