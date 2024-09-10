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

// Route::middleware('auth')->group(function () {
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

    // Event関連
    Route::get('/event', [EventController::class,'index'])->name('event.index');
    Route::get('/venue/{venue_id}/event/space', [EventController::class, 'space'])->name('event.space');
    Route::get('/venue/{venue_id}/event/create', [EventController::class,'create'])->name('event.create');
    Route::post('/venue/{venue_id}/event/store', [EventController::class,'store'])->name('event.store');
    Route::get('/event/edit/{event_id}', [EventController::class,'edit'])->name('event.edit');
    Route::post('/event/update/{event_id}', [EventController::class,'update'])->name('event.update');
    Route::post('/event/destroy/{event_id}', [EventController::class,'destroy'])->name('event.destroy');

    // UserHasEvent関連
    Route::get('user_event/index', [UserHasEventController::class, 'index'])->name('user_event.index'); // ユーザーのイベント一覧
    Route::get('user_event/show/{user_event_id}', [UserHasEventController::class, 'show'])->name('user_event.show'); // イベントの詳細
    Route::post('user_event/store', [UserHasEventController::class, 'store'])->name('user_event.store'); // イベント参加
    Route::put('user_event/update/{user_event_id}', [UserHasEventController::class, 'update'])->name('user_event.update'); // イベント参加状況の更新
    Route::delete('user_event/destroy/{user_event_id}', [UserHasEventController::class, 'destroy'])->name('user_event.destroy'); // イベント参加取消
// });

    //以下は参考
    // Route::get('/coupon_lineup/index', [CouponLineupController::class,'index'])->name('coupon_lineup.index');
    // Route::get('/coupon_lineup/create', [CouponLineupController::class,'create'])->name('coupon_lineup.create');
    // Route::post('/coupon_lineup/store', [CouponLineupController::class,'store'])->name('coupon_lineup.store');
    // Route::get('/coupon_lineup/show/{coupon_lineup_id}', [CouponLineupController::class,'show'])->name('coupon_lineup.show');
    // Route::get('/coupon_lineup/edit/{coupon_lineup_id}', [CouponLineupController::class,'edit'])->name('coupon_lineup.edit');
    // Route::post('/coupon_lineup/update/{coupon_lineup_id}', [CouponLineupController::class,'update'])->name('coupon_lineup.update');
    // Route::post('/coupon_lineup/destroy/{coupon_lineup_id}', [CouponLineupController::class,'destroy'])->name('coupon_lineup.destroy');