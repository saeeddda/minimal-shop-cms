<?php

namespace App\Providers;

use App\Models\User;
use App\Models\User\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        try {
            Permission::get()->map(function ($permission){
                Gate::define($permission->name, function (User $user) use($permission){
                    return $user->hasPermissionTo($permission);
                });
            });
        }catch (\Exception  $exception){
            report($exception);
            return;
        }

        Blade::directive('role', function ($role){
            return "<?php if( auth()->check() && auth()->user()->hasRole($role) ) : ?>";
        });

        Blade::directive('endrole', function (){
            return "<?php endif; ?>";
        });
    }
}
