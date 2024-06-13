<?php

namespace App\Policies\Admin;

use App\Models\Content\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Post $post): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->author_id;
    }

    public function delete(User $user, Post $post): bool
    {
    }

    public function restore(User $user, Post $post): bool
    {
    }

    public function forceDelete(User $user, Post $post): bool
    {
    }

    public function before(User $user, $ability): bool
    {
        if($user->user_type == 1){
            return true;
        }

        return false;
    }
}
