<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('chat.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

Broadcast::channel('chat.manager.{managerId}', function ($user, $managerId) {
    return (int) $user->id === (int) $managerId; 
});

