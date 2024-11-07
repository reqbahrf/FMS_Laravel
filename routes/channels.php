<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('admin-notifications.{id}', function ($user, $id) {
    return $user->role === 'Admin' && (int) $user->id === (int) $id;
});

Broadcast::channel('staff-notifications.{id}', function ($user, $id) {
    return $user->role === 'Staff' && (int) $user->id === (int) $id;
});
