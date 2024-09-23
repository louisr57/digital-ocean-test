<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'title');  // Default sort column
        $direction = $request->get('direction', 'asc');  // Default sort direction

        $events = Calendar::orderBy($sortBy, $direction)->paginate(50); // Paginate events

        return view('events.index', compact('events', 'sortBy', 'direction'));
    }

    public function show(Calendar $calendar)
    {
        return view('events.show', compact('calendar')); // Correct variable name for single event
    }
}
