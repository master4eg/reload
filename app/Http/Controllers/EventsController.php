<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Resources\EventsResource;
use App\Models\Event;
use Illuminate\Http\Request;


class EventsController extends Controller
{

    protected $eventsPerDay = 3;

    public function index()
    {
        return view('events.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string JSON
     */
    public function store(EventRequest $request)
    {
        if ($this->checkEventCount($request->date)) {
            $response = Event::create([
                'firstName' => $request->firstName,
                'secondName' => $request->secondName,
                'middleName' => $request->middleName,
                'phone' => $request->phone,
                'date' => $request->date]);
        } else {
            $response = ['status' => 'error', 'message' => 'Превышен суточный лимит записей.'];
        }
        return response()->json($response);
    }

    protected function checkEventCount($date)
    {
        $count = Event::where('date', $date)->count();
        $maxCount = $this->eventsPerDay;
        if ($count >= $maxCount) {
            return false;
        } else {
            return true;
        }
    }

    public function showInterval(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $events = Event::whereBetween('date', [$start, $end])->get();
        return EventsResource::collection($events);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function edit($id)
    {
        $events = Event::where('id', $id)->get();
        return EventsResource::collection($events);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return string JSON
     */
    public function update(EventRequest $request, $id)
    {
        if ($this->checkEventCount($request->date)) {
            $request = $request->only('id', 'date', 'phone', 'firstName', 'secondName', 'middleName');
            $event = Event::find($id)->update($request);
            $response = ['status' => $event ? 'ok' : 'error', $request];
        } else {
            $response = ['status' => 'error', 'message' => 'Превышен суточный лимит записей.'];
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string JSON
     */
    public function destroy($id)
    {
        $event = Event::destroy($id);
        $response = ['status' => $event ? 'ok' : 'error'];

        return response()->json($response);
    }
}
