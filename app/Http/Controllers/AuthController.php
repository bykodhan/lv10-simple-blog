<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'name.required' => __('Ad alanı zorunludur.'),
            'surname.required' => __('Soyad alanı zorunludur.'),
            'email.required' => __('E-posta alanı zorunludur.'),
            'email.email' => __('Geçerli bir e-posta adresi giriniz.'),
            'email.unique' => __('Bu e-posta adresi zaten kayıtlı.'),
            'password.required' => __('Parola alanı zorunludur.'),
            'password.min' => __('Parola en az 8 karakter olmalıdır.'),
            'password.confirmed' => __('Parolalar eşleşmiyor.'),
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::login($user);
        return redirect()->route('index')->with('success', __('Kayıt başarılı.'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => __('E-posta alanı zorunludur.'),
            'email.email' => __('Geçerli bir e-posta adresi giriniz.'),
            'password.required' => __('Parola alanı zorunludur.'),
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            return redirect()->route('auth.login')->withErrors([
                'email' => __('E-posta adresi veya parola hatalı.'),
            ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
