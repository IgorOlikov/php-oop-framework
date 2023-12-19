<?php


use Framework\Routing\Route;
use App\Controllers\HomeController;
use App\Controllers\PostController;


return [
    Route::get('/',[HomeController::class,'index']),
    Route::get('/posts/{id:\d+}',[PostController::class,'show']),
    Route::get('/hi/{name}', function(string $name) {
       return  new \Framework\Http\Response("hi $name");
    }),
];