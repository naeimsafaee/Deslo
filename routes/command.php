<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('migrate', function(){
    Artisan::call('migrate');

    return redirect()->intended();
    //    die('migrate complete');
});

Route::get('clear', function(){
    Artisan::call('config:clear');

    return redirect()->route('home');
    //    die('migrate complete');
});

Route::get('seed', function(){
    Artisan::call('db:seed', ['--class' => 'MenuItemsTableSeeder']);

    return redirect()->route('home');
    //    die('migrate complete');
});

Route::get('clear_view', function(){
    Artisan::call('view:clear');

    die('clear complete');
});
