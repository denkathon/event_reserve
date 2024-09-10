<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    // モデルに関連付けるテーブル
    protected $table = 'events';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['id'];

    // 登録・更新可能なカラムの指定
    protected $fillable = [
        'venue_id',
        'name',
        'information',
        'start_at',
        'end_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function userHasEvents()
    {
        return $this->hasMany(UserHasEvent::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function insertEvent($request, string $venue_id)
    {
        $event = $this->create([
            'venue_id' => $venue_id,
            'name' => $request->name,
            'information' => $request->information,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);
        return $event;
    }
}
