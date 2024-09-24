<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        // Determine the column to sort by and the direction
        $sort_by = $request->get('sort_by', 'course_title'); // Default to sorting by course title
        $direction = $request->get('direction', 'asc'); // Default to ascending order

        // Map sortable columns to their respective database columns
        $sortableColumns = [
            'course_title' => 'courses.course_title',
            'participant_count' => 'calendars.participant_count',
            'datefrom' => 'calendars.datefrom',
            'dateto' => 'calendars.dateto',
            'instructor_name' => 'instructors.first_name',
        ];

        // Default to 'course_title' if the provided column is not in the sortable list
        $sortColumn = $sortableColumns[$sort_by] ?? 'courses.course_title';

        // Fetch events with related data, sorted by the chosen column, and with participant count
        $events = Calendar::with(['course', 'instructor'])
            ->withCount('registrations') // Count the number of participants for each event
            ->join('courses', 'calendars.course_id', '=', 'courses.id')
            ->join('instructors', 'calendars.instructor_id', '=', 'instructors.id')
            ->orderBy($sortColumn, $direction)
            ->paginate(15);

        // Pass the sorting parameters to the view
        return view('events.index', compact('events', 'sort_by', 'direction'));
    }

    public function show($id)
    {
        // Find the event by its ID, and load related registrations and student details
        $event = Calendar::with(['course', 'instructor', 'registrations' => function ($query) {
            $query->join('students', 'students.id', '=', 'registrations.student_id')
                ->orderBy('students.last_name');
        }])
            ->findOrFail($id);

        // Return the view with the event data
        return view('events.show', compact('event'));
    }
}
