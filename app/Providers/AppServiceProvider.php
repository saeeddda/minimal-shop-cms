<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Market\CartItem;
use App\Models\Notification;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.layouts.header', function ($view){
            $view->with('unseenComment', Comment::where(['seen' => 0, 'parent_id' => null])->get());
            $view->with('notifications', Notification::where(['read_at' => null])->get());
        });

        view()->composer('site.layouts.header', function ($view){
            if(auth()->check()) {
                $view->with('cartItems', CartItem::where('user_id', auth()->user()->id)->get());
            }
        });
    }
}
