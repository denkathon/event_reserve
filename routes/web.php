<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserHasEventController;


Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register')->middleware('guest');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    //table plus
    Route::get('/venue', [VenueController::class, 'index']);
    Route::get('/', function () {
        return view('pages.top.index');
    });

    Route::get('users', [UserController::class, 'index'])->name('users.index'); // ユーザー一覧表示
    Route::post('users/store', [UserController::class, 'store'])->name('users.store'); // ユーザー作成
    Route::get('users/show/{user_id}', [UserController::class, 'show'])->name('users.show'); // ユーザー詳細表示
    Route::get('users/edit/{user_id}', [UserController::class,'edit'])->name('users.edit');
    Route::post('users/update/{user_id}', [UserController::class, 'update'])->name('users.update'); // ユーザー更新
    Route::post('users/destroy/{user_id}', [UserController::class, 'destroy'])->name('users.destroy'); // ユーザー削除

    // Venue関連
    // Route::get('/venue/index', [VenueController::class,'index'])->name('venue.index');
    Route::get('/venue/create', [VenueController::class,'create'])->name('venue.create');
    Route::post('/venue/store', [VenueController::class,'store'])->name('venue.store');
    Route::get('/venue/show/{venue_id}', [VenueController::class,'show'])->name('venue.show');
    Route::get('/venue/edit/{venue_id}', [VenueController::class,'edit'])->name('venue.edit');
    Route::post('/venue/update/{venue_id}', [VenueController::class,'update'])->name('venue.update');
    Route::post('/venue/destroy/{venue_id}', [VenueController::class,'destroy'])->name('venue.destroy');
    // routes/web.php
    Route::get('/venue/{id}', [VenueController::class, 'show'])->name('venue.show');


    // Event関連
    Route::get('/event/index', [EventController::class,'index'])->name('event.index');
    Route::get('/event/create', [EventController::class,'create'])->name('event.create');
    Route::post('/event/store', [EventController::class,'store'])->name('event.store');
    Route::get('/event/show/{event_id}', [EventController::class,'show'])->name('event.show');
    Route::get('/event/edit/{event_id}', [EventController::class,'edit'])->name('event.edit');
    Route::post('/event/update/{event_id}', [EventController::class,'update'])->name('event.update');
    Route::post('/event/destroy/{event_id}', [EventController::class,'destroy'])->name('event.destroy');

    // UserHasEvent関連
    Route::get('user-events', [UserHasEventController::class, 'index'])->name('user_events.index'); // ユーザーのイベント一覧
    Route::get('user-events/{id}', [UserHasEventController::class, 'show'])->name('user_events.show'); // イベントの詳細
    Route::post('user-events', [UserHasEventController::class, 'store'])->name('user_events.store'); // イベント参加
    Route::put('user-events/{id}', [UserHasEventController::class, 'update'])->name('user_events.update'); // イベント参加状況の更新
    Route::delete('user-events/{id}', [UserHasEventController::class, 'destroy'])->name('user_events.destroy'); // イベント参加取消
});


    //以下は参考
    // Route::get('/coupon_lineup/index', [CouponLineupController::class,'index'])->name('coupon_lineup.index');
    // Route::get('/coupon_lineup/create', [CouponLineupController::class,'create'])->name('coupon_lineup.create');
    // Route::post('/coupon_lineup/store', [CouponLineupController::class,'store'])->name('coupon_lineup.store');
    // Route::get('/coupon_lineup/show/{coupon_lineup_id}', [CouponLineupController::class,'show'])->name('coupon_lineup.show');
    // Route::get('/coupon_lineup/edit/{coupon_lineup_id}', [CouponLineupController::class,'edit'])->name('coupon_lineup.edit');
    // Route::post('/coupon_lineup/update/{coupon_lineup_id}', [CouponLineupController::class,'update'])->name('coupon_lineup.update');
    // Route::post('/coupon_lineup/destroy/{coupon_lineup_id}', [CouponLineupController::class,'destroy'])->name('coupon_lineup.destroy');