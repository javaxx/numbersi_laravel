<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登录页面
    public function index()
    {
        return view('login.index');
    }
    //登录
    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6|max:30',
            'is_remember' => 'integer',
        ]);

        $user = request(['email', 'password']);
        $remember = boolval(request('is_remember'));
        if (true == \Auth::attempt($user, $remember)) {
            return redirect('/posts');
        }

        return \Redirect::back()->withErrors("用户名密码错误");
    }
    //登出
    public function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }
}
