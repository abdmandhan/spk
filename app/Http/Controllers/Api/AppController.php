<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    //
    public function verify()
    {
        $user = Auth::user();
        return $this->success([
            'user'  => $user,
            'token' =>  $user->createToken('CRM')->plainTextToken
        ], 'success verify');
    }


    public function options()
    {
        return $this->success();
    }
}
