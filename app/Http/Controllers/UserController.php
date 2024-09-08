<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
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
    public function store(Request $request, $authId)
    {
        $request->validate([
            'name' => 'required',
            'auth_id' => 'required|exists:auths,id',
            'e_mail' => 'nullable|email',
            'phone_number' => 'nullable|string',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'auth_id' => $authId,
            'e_mail' => $request->e_mail,
            'phone_number' => $request->phone_number,
        ]);
    
        return response()->json(['message' => 'ユーザー情報が登録されました。'], 200);
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
}
