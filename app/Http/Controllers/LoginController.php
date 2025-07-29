<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function auth(Request $request)
    {
        $credencias = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],

            ],
            [
                'email.required' => 'O campo Email é obrigatório!',
                'email.email' => 'O Email informado é inválido!',

                'password.required' => 'O campo Senha é obrigatório!'

            ]
        );

        if (Auth::attempt($credencias)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        } else {
            return redirect()->back()->with('erro', 'Usuario ou senha inválida!');
        }

    }



}
