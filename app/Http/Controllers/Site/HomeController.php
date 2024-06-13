<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        Auth::loginUsingId(1);

        $slideShows = Banner::where(['status' => 1, 'position' => 0])->get();
        $topBanners = Banner::where(['status' => 1, 'position' => 1])->take(2)->get();
        $middleBanners = Banner::where(['status' => 1, 'position' => 2])->take(2)->get();
        $bottomBanners = Banner::where(['status' => 1, 'position' => 3])->take(1)->get();

        $brands = Brand::where(['status' => 1])->take(12)->get();

        $mostVisitedProducts = Product::where(['status' => 1, 'marketable' => 1])->latest()->take(8)->get();
        $offerProducts = Product::where(['status' => 1, 'marketable' => 1])->latest()->take(8)->get();

        return view('site.home1', compact(
            'slideShows',
            'topBanners',
            'middleBanners',
            'bottomBanners',
            'brands',
            'mostVisitedProducts',
            'offerProducts'
        ));
    }
}
