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


    public function findAllEvent($request)
    {
        $query = Event::query();

        if ($request->filled('search_id')) {
            $query->where('id', $request->input('search_id'));
        }
        if ($request->filled('search_name')) {
            $query->where('name', 'like', '%' . $request->input('search_name') . '%');
        }
        if ($request->filled('search_information')) {
            $query->where('information', 'like', '%' . $request->input('search_information') . '%');
        }
        if ($request->filled('search_start_at')) {
            $start_at = Carbon::parse($request->input('search_start_at'))->subHours(9) ?? null;
            $query->where('start_at', '>=', $start_at);
        }
        if ($request->filled('search_end_at')) {
            $end_at = Carbon::parse($request->input('search_end_at'))->subHours(9) ?? null;
            $query->where('end_at', '<=', $end_at);
        }
    
        $events = $query->paginate(10);
        return $events;
    }




    public function userHasEvents()
    {
        return $this->hasMany(UserHasEvent::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
