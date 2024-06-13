<?php

namespace App\Http\Controllers\Site\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(){
        return view('site.account.compare-list');
    }
}
