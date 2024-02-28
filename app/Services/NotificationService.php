<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\User;

class NotificationService extends BaseService
{
    public function getUserNotifications()
    {
        $user = auth()->user();
        return $user->notifications()->get();
    }

    public function markAsRead($id): void
    {
        $user = auth()->user();
        $user->notifications->where('id', $id)->markAsRead();
    }
    
    public function notificationCount($user_id)
    {
        $user =  auth()->user();
        return $user->notifications()->count();
    }

    // public function getUser($user_id)
    // {
    //     $user = User::find($user_id);
    //     if (!$user)
    //         throw new NotFoundException(trans('user_not_found'));
    //     return $user ;
    // }

    public function destroy($id): void
    {
        $user = auth()->user();
        $user->notifications()->where('id', $id)->delete();
    }


}
