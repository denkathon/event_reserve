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
    public function index()
    {
      
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.event.create');
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
    public function show(Request $request)
    {
          $venue_id = $request->route('venue_id');
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

    public function space(Request $request, /*string $id*/)
    {
        //$venue_id = $request->route('venue_id');
        $events = Event::all();
        return view('pages.event.space', compact('events'));
        //
    }

}
