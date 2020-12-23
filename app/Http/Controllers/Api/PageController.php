<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function dashboard()
    {
        return $this->success([
            'users' => User::all()
        ]);
    }
}
