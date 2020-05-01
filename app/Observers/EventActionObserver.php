<?php

namespace App\Observers;

use App\Event;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class EventActionObserver
{
    public function created(Event $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Event'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }
}
