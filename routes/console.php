<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('run', function (){
    $this->info('Welcome to swiftdely app');

    $this->comment('Clearing and Migrating DB...');
    Artisan::call('migrate:fresh');
    $this->info('Migration done');

    $this->comment('Installing passport...');
    Artisan::call('passport:install');
    $this->info('Passport installed');
});
