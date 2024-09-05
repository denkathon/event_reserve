<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    // モデルに関連付けるテーブル
    protected $table = 'venues';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['id'];

    // 登録・更新可能なカラムの指定
    protected $fillable = [
        'name',
        'information',
        'address',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
