<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    // モデルに関連付けるテーブル
    protected $table = 'users';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['id'];

    // 登録・更新可能なカラムの指定
    protected $fillable = [
        'name',
        'e_mail',
        'phone_number',
        'has_stamp',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function auth()
    {
        return $this->belongsTo(Auth::class);
    }

    public function userHasEvents()
    {
        return $this->hasMany(UserHasEvent::class);
    }

    public function insertUser($request, string $auth_id)
    {
        return $this->create([
            'name' => $request->name,
            'auth_id' => $auth_id,
        ]);
    }
}
