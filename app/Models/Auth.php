<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Auth extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    // モデルに関連付けるテーブル
    protected $table = 'auths';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['id'];

    // 登録・更新可能なカラムの指定
    protected $fillable = [
        'user_name',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function insertAuth($request)
    {
        $auth = $this->create([
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
        ]);
    
        // デバッグ用の出力
        \Log::info('Created Auth:', ['auth' => $auth]);
    
        return $auth->id;
    }
}