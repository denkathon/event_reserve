<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\UserHasEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $event, $user_has_event;
    public function __construct()
    {
        $this->event = new Event();
        $this->user_has_event = new UserHasEvent();
    }
    public function index(Request $request)
    {
        $events = Event::all();
        return view('pages.event.index', compact('events'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $venue_id = $request->route('venue_id');
        $startAt = $request->query('start_at');
        $endAt = $request->query('end_at');
        return view('pages.event.create', compact('venue_id','startAt', 'endAt'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $user_id = Auth::user()->id;
            $venue_id = $request->route('venue_id');
            if($venue_id){
                $event = $this->event->insertEvent($request, $venue_id);
            } else{
                return redirect()->route('event.space', ['venue_id' => $venue_id])->with('flash.error', '登録に失敗しました。');
            }
    
            if($user_id){
                $registerUserHasEvent = $this->user_has_event->insertUserHasEvent($request, $user_id, $event->id);
                DB::commit();
                return redirect()->route('event.show', ['event_id' => $event->id])->with('flash.success', '登録に成功しました。');
            } else {
                DB::rollBack();
                return redirect()->route('event.space', ['venue_id' => $venue_id])->with('flash.error', '登録に失敗しました。');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/login')->with('flash.error', '登録に失敗しました。');
        }
    }

    /**
     * Display the specified resource.
     */
    // app/Http/Controllers/EventController.php
    public function show(Request $request, string $event_id)
    {
        // イベントの取得
        $event = Event::findOrFail($event_id);
        
        // イベントの会場の取得
        $venue = $event->venue;
        
        // イベントに関連するユーザーの取得
        $userDetails = $event->userHasEvents->map(function($userHasEvent) {
            return $userHasEvent->user;
        })->map(function($user) {
            return [
                'name' => $user->name,
                'e_mail' => $user->e_mail,
                'phone_number' => $user->phone_number,
            ];
        });
        return view('pages.event.show', compact('event', 'venue', 'userDetails'));
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

    public function space(Request $request)
    {
        $venue_id = $request->route('venue_id');
        $events = Event::where('venue_id', $venue_id)->with('venue')->get();
        return view('pages.event.space', compact('events', 'venue_id'));
    }

}
