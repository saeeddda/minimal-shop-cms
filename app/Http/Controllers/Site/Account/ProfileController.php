<?php

namespace App\Http\Controllers\Site\Account;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('site.account.profile');
    }
}
