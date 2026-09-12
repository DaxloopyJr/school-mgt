<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('school:about', function () {
    $this->info('School Management System - Laravel 11 + Blade + Bootstrap + MySQL');
})->purpose('About this application');
