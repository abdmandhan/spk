<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = (object) $request->validate([
            'email'     => ['required', 'string', 'exists:users', 'email'],
            'password'  => ['required', 'string'],
        ]);

        $user = User::where('email', $data->email)->first();

        if (Hash::check($data->password, $user->password)) {
            return $this->success([
                'user'  => $user,
                'token' =>  $user->createToken('CRM')->plainTextToken
            ], 'success login');
        } else {
            return $this->failed([], 'password salah');
        }
    }
}
