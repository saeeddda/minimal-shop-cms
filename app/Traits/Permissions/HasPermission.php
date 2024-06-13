<?php

namespace App\Traits\Permissions;

trait HasPermission
{
    public function hasPermission($permission) : bool{
        return (bool) $this->permissions()->where('name', $permission->name)->get()->count();
    }

    public function hasRole(...$roles)  {
        foreach ($roles as $role){
            if($this->roles->contains('name', $role))
                return true;
        }
        return false;
    }

    public function hasPermissionThroughRole($permission) : bool{
        foreach ($permission->roles as $role){
            if($this->roles->contains($role))
                return true;
        }
        return false;
    }

    public function hasPermissionTo($permission) : bool{
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }
}
