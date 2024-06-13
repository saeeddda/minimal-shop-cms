<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Content\Page;

class PageController extends Controller
{
    public function index(Page $page)
    {
        return view('site.page', compact('page'));
    }
}
