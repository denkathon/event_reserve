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
//oute::middleware('auth:sanctum')->group(function () {

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
    Route::get('user', [UserController::class, 'index'])->name('user.index'); // ユーザー一覧表示
    Route::post('user/store', [UserController::class, 'store'])->name('user.store'); // ユーザー作成
    Route::get('users/show/{user_id}', [UserController::class, 'show'])->name('user.show'); // ユーザー詳細表示
    Route::post('user/update/{user_id}', [UserController::class, 'update'])->name('user.update'); // ユーザー更新
    Route::post('user/destroy/{user_id}', [UserController::class, 'destroy'])->name('user.destroy'); // ユーザー削除

    // Venue関連
    Route::get('venue/index', [VenueController::class, 'index'])->name('venue.index'); // 会場一覧表示
    Route::get('venue/show/{venue_id}', [VenueController::class, 'show'])->name('venue.show'); // 会場詳細表示
    Route::post('venue/store', [VenueController::class, 'store'])->name('venue.store'); // 会場作成
    Route::put('venue/update/{venue_id}', [VenueController::class, 'update'])->name('venue.update'); // 会場更新
    Route::delete('venue/destroy/{venue_id}', [VenueController::class, 'destroy'])->name('venue.destroy'); // 会場削除

    // Event関連
    Route::get('event/index', [EventController::class, 'index'])->name('event.index'); // イベント一覧表示
    Route::get('event/space', [EventController::class, 'space'])->name('event.space'); // イベントイベントスペース一覧表示
    Route::get('event/create', [EventController::class, 'create'])->name('event.create'); // イベント詳細新規作成
    Route::post('event/store', [EventController::class, 'store'])->name('event.store'); // イベント作成（イベント予約）
    Route::get('event/show/{event_id}', [EventController::class, 'show'])->name('event.show'); // イベント詳細表示
    Route::get('event/index', [EventController::class, 'index'])->name('event.index'); // イベント一覧表示
    Route::put('event/update/{event_id}', [EventController::class, 'update'])->name('event.update'); // イベント更新
    Route::delete('event/destroy/{event_id}', [EventController::class, 'destroy'])->name('event.destroy'); // イベント削除

    // UserHasEvent関連
    Route::get('user_event/index', [UserHasEventController::class, 'index'])->name('user_event.index'); // ユーザーのイベント一覧
    Route::get('user_event/show/{user_event_id}', [UserHasEventController::class, 'show'])->name('user_event.show'); // イベントの詳細
    Route::post('user_event/store', [UserHasEventController::class, 'store'])->name('user_event.store'); // イベント参加
    Route::put('user_event/update/{user_event_id}', [UserHasEventController::class, 'update'])->name('user_event.update'); // イベント参加状況の更新
    Route::delete('user_event/destroy/{user_event_id}', [UserHasEventController::class, 'destroy'])->name('user_event.destroy'); // イベント参加取消
//});

// Route::get('{any}', function () {
//     return view('home');
// })->where('any', '.*');