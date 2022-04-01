<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('admin.login', [
            'category_name' => 'auth',
            'page_name' => 'auth_boxed',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'ログイン',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return $this->loggedOut($request);
    }

    public function loggedOut(Request $request)
    {
        return redirect(route('admin.login'));
    }

    protected function authenticated(Request $request, $user)
    {
        // ログイン後リダイレクト先を管理者ページに限定する。
        $intended_url = $request->session()->get("url.intended");
        $is_user_route = collect(Route::getRoutes())->filter(function($route) use($intended_url) {
            return $route->named("admin.*") and $route->matches(request()->create($intended_url));
        })->isNotEmpty();
        if(!$is_user_route) {
            $request->session()->forget("url.intended");
        }
    }
}