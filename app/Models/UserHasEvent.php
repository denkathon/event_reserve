<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserHasEvent extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    // モデルに関連付けるテーブル
    protected $table = 'user_has_events';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['id'];

    // 登録・更新可能なカラムの指定
    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function auth()
    {
        return $this->hasOne(Auth::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function insertUserHasEvent($request, string $user_id, string $event_id)
    {
        return $this->create([
            'user_id' => $user_id,
            'event_id' => $event_id,
            'status' => 1
        ]);
    }
}
