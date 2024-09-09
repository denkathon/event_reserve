<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Venue;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $event;
    public function __construct()
    {
        $this->event = new Event();
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
         // クエリパラメータで start_time と end_time を受け取る
         $startAt = $request->query('start_at');
         $endAt = $request->query('end_at');
         return view('pages.event.create', compact('startAt', 'endAt'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = new Event();
        $event->name = $request->name;
        $event->venue_id = $request->input('venue_id');
        $event->information = $request->information;
        $event->venue_id = $request->venue_id;
        $event->start_at = $request->start_at;
        $event->end_at = $request->end_at;
        $event->save();

        return redirect()->route('pages.event.show', $event->id);
        //
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

    public function space(Request $request, /*string $id*/)
    {
        //$venue_id = $request->route('venue_id');
        $events = Event::all();
        return view('pages.event.space', compact('events'));
        //
    }

}
