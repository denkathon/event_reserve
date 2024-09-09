<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }

    public function register(Request $request)
    {
        $request->validate([
            'user_name' => 'required|unique:auths',
            'password' => 'required|min:6',
            'name' => 'required',
        ]);

        // Authsテーブルに登録
        $auth = Auth::create([
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
        ]);

        $auth_id = $auth->id;

        



        return redirect('/login')->with('success', 'アカウントが作成されました');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'password' => 'required',
        ]);
    
        $auth = \DB::table('auths')->where('user_name', $request->user_name)->first();
    
        if ($auth && Hash::check($request->password, $auth->password)) {
            $user = \DB::table('users')->where('auth_id', $auth->id)->first();
            FacadesAuth::loginUsingId($user->id);
            return redirect('/')->with('success', 'ログインに成功しました');
        }
    
        return back()->withErrors(['login_error' => '認証に失敗しました']);
    }
    

    public function logout()
    {
        FacadesAuth::logout();
        return redirect('/login')->with('success', 'ログアウトしました');
    }
}
