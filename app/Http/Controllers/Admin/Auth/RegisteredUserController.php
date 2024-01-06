<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->admin_code === '1111') {
            // 出品者コードが正しい場合、新規登録処理を実行する
            // ...（通常の新規登録処理
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Admin::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'admin_code' => 'required|in:1111', // 出品者コードが1111であるかを確認
            ]);
            $user = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            event(new Registered($user));
            Auth::guard('admin')->login($user);
            return redirect(RouteServiceProvider::ADMIN_HOME);
        }else {
            // 出品者コードが正しくない場合はエラーを返すか、適切な処理を行う
            return redirect()->route('admin.register')->withErrors(['admin_code' => '出品者コードが違います。']);
        }
    }
}
