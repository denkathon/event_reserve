<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserHasEventController;

// 認証関係
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// 認証が必要なルート
// Route::middleware('auth:sanctum')->group(function () {

    // Auth関連
    Route::get('me', [AuthController::class, 'me'])->name('auth.me'); // ログイン中のユーザー情報
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout'); // ログアウト


    //以下は参考
    // Route::get('/coupon_lineup/index', [CouponLineupController::class,'index'])->name('coupon_lineup.index');
    // Route::get('/coupon_lineup/create', [CouponLineupController::class,'create'])->name('coupon_lineup.create');
    // Route::post('/coupon_lineup/store', [CouponLineupController::class,'store'])->name('coupon_lineup.store');
    // Route::get('/coupon_lineup/show/{coupon_lineup_id}', [CouponLineupController::class,'show'])->name('coupon_lineup.show');
    // Route::get('/coupon_lineup/edit/{coupon_lineup_id}', [CouponLineupController::class,'edit'])->name('coupon_lineup.edit');
    // Route::post('/coupon_lineup/update/{coupon_lineup_id}', [CouponLineupController::class,'update'])->name('coupon_lineup.update');
    // Route::post('/coupon_lineup/destroy/{coupon_lineup_id}', [CouponLineupController::class,'destroy'])->name('coupon_lineup.destroy');


    // User関連
    Route::get('users', [UserController::class, 'index'])->name('users.index'); // ユーザー一覧表示
    Route::post('users/store', [UserController::class, 'store'])->name('users.store'); // ユーザー作成
    Route::get('users/show/{user_id}', [UserController::class, 'show'])->name('users.show'); // ユーザー詳細表示
    Route::post('users/update/{user_id}', [UserController::class, 'update'])->name('users.update'); // ユーザー更新
    Route::post('users/destroy/{user_id}', [UserController::class, 'destroy'])->name('users.destroy'); // ユーザー削除

    // Venue関連
    Route::get('venues', [VenueController::class, 'index'])->name('venues.index'); // 会場一覧表示
    Route::get('venues/{id}', [VenueController::class, 'show'])->name('venues.show'); // 会場詳細表示
    Route::post('venues', [VenueController::class, 'store'])->name('venues.store'); // 会場作成
    Route::put('venues/{id}', [VenueController::class, 'update'])->name('venues.update'); // 会場更新
    Route::delete('venues/{id}', [VenueController::class, 'destroy'])->name('venues.destroy'); // 会場削除

    // Event関連
    Route::get('/event/index', [EventController::class,'index'])->name('event.index');
    Route::get('/event/create', [EventController::class,'create'])->name('event.create');
    Route::post('/event/store', [EventController::class,'store'])->name('event.store');
    Route::get('/event/show/{event_id}', [EventController::class,'show'])->name('event.show');
    Route::get('/event/edit/{event_id}', [EventController::class,'edit'])->name('event.edit');
    Route::post('/event/update/{event_id}', [EventController::class,'update'])->name('event.update');
    Route::post('/event/destroy/{event_id}', [EventController::class,'destroy'])->name('event.destroy');

    //Route::get('events', [EventController::class, 'index'])->name('events.index'); // イベント一覧表示
    //Route::get('events/{id}', [EventController::class, 'show'])->name('events.show'); // イベント詳細表示
    //Route::get('events/create', [EventController::class, 'create'])->name('events.create'); // イベント詳細新規作成
    //Route::post('events', [EventController::class, 'store'])->name('events.store'); // イベント作成
    //Route::put('events/{id}', [EventController::class, 'update'])->name('events.update'); // イベント更新
    //Route::delete('events/{id}', [EventController::class, 'destroy'])->name('events.destroy'); // イベント削除

    // UserHasEvent関連
    Route::get('user-events', [UserHasEventController::class, 'index'])->name('user_events.index'); // ユーザーのイベント一覧
    Route::get('user-events/{id}', [UserHasEventController::class, 'show'])->name('user_events.show'); // イベントの詳細
    Route::post('user-events', [UserHasEventController::class, 'store'])->name('user_events.store'); // イベント参加
    Route::put('user-events/{id}', [UserHasEventController::class, 'update'])->name('user_events.update'); // イベント参加状況の更新
    Route::delete('user-events/{id}', [UserHasEventController::class, 'destroy'])->name('user_events.destroy'); // イベント参加取消
//});

// Route::get('{any}', function () {
//     return view('home');
// })->where('any', '.*');