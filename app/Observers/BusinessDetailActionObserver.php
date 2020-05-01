<?php

namespace App\Observers;

use App\BusinessDetail;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class BusinessDetailActionObserver
{
    public function created(BusinessDetail $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'BusinessDetail'];
        $users = \App\User::whereHas('roles', function ($q) {return $q->where('title', 'Admin');})->get();
        Notification::send($users, new DataChangeEmailNotification($data));

    }
}
