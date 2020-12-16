<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    //
    public function app()
    {
        $menuConfig = config('menu');

        $menu = [];
        foreach ($menuConfig as $key => $value) {
            if (in_array(Auth::user()->getRoleNames()[0], $value['roles'])) $menu[] = $value;
        }

        return $this->success([
            'auth'          => Auth::user(),
            'menu'          => $menu,
            'app_name'      => config('app.name'),
        ]);
    }
}
