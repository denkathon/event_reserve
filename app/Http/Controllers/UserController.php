<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->users = new User();
    }

    public function index(Request $request)
    {
        // return view('pages.user.index');
        $users = User::all(); // すべてのユーザーを取得
        return view('pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $check_auth_id = $request->check_auth_id;
        if ($check_auth_id) {
            $registerUser = $this->user->insertUser($request);
            return redirect()->view('pages.user.index')->with('success', '登録に成功しました。');
        } else {
            return redirect()->view('pages.top.index')->with('error', '登録に失敗しました。');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $events = $user->userHasEvents->map(function ($userHasEvent){
            return $userHasEvent->event;
        });
        return view('pages.users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $user->adjustTimezone();
        return view('pages.coupon_lineup.edit', compact('coupon_lineup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('flash.success', '削除に成功しました。');
    }
}
