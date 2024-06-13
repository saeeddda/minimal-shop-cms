<?php

namespace App\Http\Controllers\Site\Account;

use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index()
    {
        return view('site.account.address');
    }
}
