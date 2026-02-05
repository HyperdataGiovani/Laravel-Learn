<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(){
        $data = User::get();

        return view('home', ['title' => 'Home'], compact('data')); 
    }

    public function create(){
        return view('CRUD/create', ['title' => 'New User']);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['username'] = $request->username;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['email_verified_at'] = now();
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = Str::random(10);

        User::create($data);

        return redirect()->route('admin.index');
    }

    public function edit(Request $request, $id){
        $data = User::find($id);

        return view('CRUD/edit', ['title' => 'Edit'], compact('data'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['username'] = $request->username;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['email_verified_at'] = now();
        if($request->password){
        $data['password'] = Hash::make($request->password);
        }
        $data['remember_token'] = Str::random(10);

        User::whereId($id)->update($data);

        return redirect()->route('admin.index');
    }

    public function delete(Request $request, $id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('admin.index');
    }
}
