<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $users;
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
        // 
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
        $users = User::find($id);
        $users->adjustTimezone();
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
        $users = User::find($id);
        $users->delete();
        return redirect()->route('users.index')->with('flash.success', '削除に成功しました。');
    }
}
