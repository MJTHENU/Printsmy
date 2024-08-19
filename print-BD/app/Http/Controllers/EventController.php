<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Validator;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        if ($events->isEmpty()) {
            return response()->json(['error' => 'No events found'], 404);
        }

        return response()->json(['events' => $events], 200);
    }

    public function show($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        return response()->json(['event' => $event], 200);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'status' => 'required|in:start,soon,complete',
        ]);

        // Create a new event using the validated data
        $event = Event::create($validatedData);

        // Return a JSON response with the created event data
        return response()->json(['event' => $event], 201);
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

         $validatedData = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'event_date' => 'date',
            'status' => 'in:start,soon,complete',
        ]);

        $event->update($request->all());

        return response()->json(['event' => $event], 200);
    }

    public function destroy($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted successfully'], 200);
    }
}
