<?php

use Illuminate\Support\Facades\Route;
use App\Console\Commands\CheckInactiveUsers;

Route::command('inactivity:check', CheckInactiveUsers::class);
