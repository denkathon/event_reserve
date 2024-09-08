<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Auth;
use App\Models\User;

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
            'password' => 'required|min:8',
            'name' => 'required',
            'e_mail' => 'nullable|email',
            'phone_number' => 'nullable|string',
        ]);
    
        // authsテーブルに保存
        $auth = Auth::create([
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password), // パスワードをハッシュ化
        ]);
    
        // usersテーブルへの登録はUserControllerに委任
        $userStoreResponse = app(UserController::class)->store($request, $auth->id);
    
        // usersテーブルへの登録結果に基づいてフロントエンドにレスポンスを返す
        if ($userStoreResponse->status() === 200) {
            return response()->json(['message' => 'アカウント登録が完了しました。'], 200);
        } else {
            return response()->json(['message' => 'ユーザー登録に失敗しました。'], 500);
        }
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $user = User::where('user_name', $request->user_name)->first();
        
        if (!$user || $request->password !== $user->password) { // パスワードをハッシュせずにそのまま比較
            return response()->json(['message' => 'ログインに失敗しました'], 401);
        }
    
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json(['token' => $token, 'message' => 'ログイン成功']);
    }

    public function me(Request $request)
    {
        return $request->user(); // 認証されているユーザーを返す
    }
}
