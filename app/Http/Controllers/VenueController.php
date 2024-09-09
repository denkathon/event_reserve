<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;


class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //なんやこれ
    protected $venues;
    public function __construct()
    {
        $this->venues = new Venue();
    }

    // public function index(Request $request)
    // {
    //     $venues = $this->venue->findAllVenue($request);
    //     return view('pages.venue.index', compact('venue'));
    // }

    public function index()
    {
        // venuesテーブルからすべてのデータを取得
        $venues = Venue::all(); // $idは必要ありません
        return view('pages.venue.index', ['venues' => $venues]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $venue = Venue::findOrFail($id); 
    return view('pages.venue.show', ['venue' => $venue]);
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
}
