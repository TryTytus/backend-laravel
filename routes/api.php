<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

use \Illuminate\Support\Facades\Auth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/secret2', function (Request $request) {
    return "DUPAAA";
})->middleware('auth:sanctum');

//Route::get('/secret2', function (Request $request) {
//    if (!Auth::check() or Auth::user())
//        response()->json(["error" => "Unauthorized"], 401);
//
//
//})->middleware('auth:sanctum');


Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/users/{id}', 'show');
    Route::post('/users', 'store');
    Route::put('/users/{id}', 'update')->middleware('auth:sanctum');
    Route::delete('/users/{id}', 'destroy')->middleware('auth:sanctum');
});


Route::apiResource('/comments', CommentController::class);


Route::controller(PostLikeController::class)->group(function () {
    Route::post('/posts/{post}/likes', 'like')->middleware('auth:sanctum');
    Route::delete('/posts/{post}/likes', 'unlike')->middleware('auth:sanctum');
});

Route::controller(PostLikeController::class)->group(function () {
    Route::post('/comments/{post}/likes', 'like')->middleware('auth:sanctum');
    Route::delete('/comments/{post}/likes', 'unlike')->middleware('auth:sanctum');
});

Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index')->middleware('auth:sanctum');
    Route::get('/posts/{post}', 'show');
    Route::post('/posts', 'store')->middleware('auth:sanctum');
    Route::put('/posts/{post}', 'update')->middleware('auth:sanctum')->middleware('auth');
    Route::delete('/posts/{post}', 'destroy')->middleware('auth:sanctum');
});



Route::get('/login', function (Request $request) {

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
    {
        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'token' => $token,
        ]);
    }

    return response()->json(['error' => 'Unauthorized'], 401);

})->name('login');







//Route::get('/users', [UserController::class, 'index']);
