<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;



class Login extends Controller
{
  public function index(){
    return view('login');
 }

 public function register(Request $req){
    DB::table('tbl_user')->insert([
        'nama_user'=> $req->nama_user,
        'email'=> $req->email,
        'password'=> $req->password
    ]);

    return redirect('/Login');
 }

public function signIn(Request $req){
    $user = DB::table('tbl_user')->where('email', $req->email)->first();
    if ($user->password == $req->password) {
        Session()->put('id', $user->id);
        echo "data berhasil disimpan".$req->session()->get('id');
        return redirect('/');
    }else{
        return redirect('/Login');
    }
}

public function logout(){
    Session::forget('id');
    return redirect('/');
}

}

