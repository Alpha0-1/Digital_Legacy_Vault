<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('vault.{id}', function ($user, $id) {
    return $user->vault->id === $id;
});

Broadcast::channel('inactivity.{id}', function ($user, $id) {
    return $user->id === $id;
});
