<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function readAll(Request $request){
        $user = User::find(1);

        foreach ($user->notifications as $notification) {
            $notification->markAsRead();
        }
    }
}
