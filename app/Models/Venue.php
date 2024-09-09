<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

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

    public function findAllVenue($request)
    {
        $query = Venue::query();

        if ($request->filled('search_id')) {
            $query->where('id', $request->input('search_id'));
        }
        if ($request->filled('search_name')) {
            $query->where('name', 'like', '%' . $request->input('search_name') . '%');
        }
        if ($request->filled('search_start_at')) {
            $start_at = Carbon::parse($request->input('search_start_at'))->subHours(9) ?? null;
            $query->where('start_at', '>=', $start_at);
        }
        if ($request->filled('search_end_at')) {
            $end_at = Carbon::parse($request->input('search_end_at'))->subHours(9) ?? null;
            $query->where('end_at', '<=', $end_at);
        }
    
        $venues = $query->paginate(10);
        // $couponLineups = $this->adjustCouponLineupsTimezone($couponLineups);
        return $venues;
    }

    


    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
