<?php

namespace App\Http\Controllers;

use App\Mail\MailVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function login() {
        if (Auth::check()) {
            return redirect()
                ->route('index.home');
        }
        return view('auth.login');
    }

    public function postLogin(Request $request) {
        $email = $request->input('username');
        $password = $request->input('password');

        $user = User::where('email', $email)
            ->first();

        if (!$user) {
            // wrong email or password
            return redirect()
                ->back()
                ->withInput($request->except('password'))
                ->with([
                    'message_type' => 'warning',
                    'message' => 'Wrong email or password, please try again'
                ]);
        }
        if (!Hash::check($password, $user->password)) {
            // wrong email or password
            return redirect()
                ->back()
                ->withInput($request->except('password'))
                ->with([
                    'message_type' => 'warning',
                    'message' => 'Wrong email or password, please try again'
                ]);
        } else if ($user->email_verified_at == null) {
            // please activate your account
            return redirect()
                ->back()
                ->withInput($request->except('password'))
                ->with([
                    'message_type' => 'info',
                    'message' => 'Please verify your email'
                ]);
        }

        Auth::login($user);
        if ($request->has('_next') && !empty($request->input('_next'))) {
            return redirect($request->input('_next'));
        }
        if (session()->has('url.intended')) {
            $redirectTo = session()->get('url.intended');
            session()->forget('url.intended');
            $request->session()->regenerate();
            return redirect($redirectTo);
        }
        return redirect()
            ->route('index.home');
    }

    public function register() {
        return view('auth.register');
    }

    public function postRegister(Request $request) {
        $name = $request->input('name');
        $email = $request->input('username');
        $password = $request->input('password');
        $confirmPassword = $request->input('confirm_password');

        $check = User::where('email', $email)->first();
        if ($check) {
            $loginLink = route('auth.login');
            return redirect()
                ->back()
                ->with([
                    'message_type' => 'warning',
                    'message' => 'Email already registered, please <a href="'.$loginLink.'">login here</a>'
                ])
                ->withInput($request->except(['password', 'confirm_password']));
        }
        if ($password !== $confirmPassword) {
            return redirect()
                ->back()
                ->with([
                    'message_type' => 'warning',
                    'message' => "Confirmation password doesn't match"
                ])
                ->withInput($request->except(['password', 'confirm_password']));
        }
        $user = new User();
        $user->email = $email;
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->is_admin = false;
        $user->save();

        Mail::to($user)
            ->send(new MailVerification(Crypt::encryptString($user->email)));

        return redirect()
            ->back()
            ->with([
                'message_type' => 'success',
                'message' => 'Registration success, please check your email'
            ]);
    }

    public function logout() {
        Auth::logout();
        return redirect()
            ->route('index.home');
    }

    public function verification(Request $request) {
        $token = $request->input('token');
        if (!$token) abort(404);
        try {
            $email = Crypt::decryptString($token);
            if (empty($email)) abort(404);
            $user = User::where('email', $email)
                ->whereNull('email_verified_at')
                ->first();
            if (!$user) abort(404);
            $user->email_verified_at = Carbon::now();
            $user->save();
            return redirect()
                ->route('auth.login')
                ->with([
                    'message_type' => 'success',
                    'message' => 'Email verified successfully, please login'
                ]);
        } catch (DecryptException $ex) {
            abort(404);
        }
    }

}
