<?php

namespace LAIRE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Calendar;

use LAIRE\Event;

class CalendarController extends Controller
{
    public function viewCalendar(){
    	$calendar = $this->makeCalendar();
    	return view('calendar', ['calendar' => $calendar, 'eventToShow' => null]);
    }

    public function viewEvent($eventID){
    	$event = Event::where('id', $eventID)->first();
    	$calendar = $this->makeCalendar();
    	return view('calendar', ['calendar' => $calendar, 'eventToShow' => $event]);
    }

    public function viewAddEventForm(){
    	if (Auth::user() !== null and Auth::user()->privilege() === 1){
    		return view('event-form', ['title' => null, 'description' => null,
    									'startTime' => null, 'endTime' => null,
    									 'destination' => 'createEvent', 'eventID' => null]);
    	} else {
    		return $this->viewCalendar();
    	}
    }

    public function createEvent(Request $request){
    	if (Auth::user() !== null and Auth::user()->privilege() === 1){
    		$this->validator($request->all())->validate();
    		Event::create([
    			'title' => $request->title,
    			'description' => $request->description,
    			'startTime' => date('Y-m-d\TH:i',strtotime($request->startTime)),
    			'endTime' => date('Y-m-d\TH:i',strtotime($request->endTime)),
    		]);
    	}
    	return redirect()->route('viewCalendar');
    }

    public function viewEditEventForm($eventID){
    	if (Auth::user() !== null and Auth::user()->privilege() === 1){
    		$event = Event::where('id', $eventID)->first();
    		if ($event === null){
    			$title = null;
    			$description = null;
    			$startTime = null;
    			$endTime = null;
    		} else {
    			$title = $event->title;
    			$description = $event->description;
    			$startTime = date('Y-m-d\TH:i', strtotime($event->startTime));
    			$endTime = date('Y-m-d\TH:i', strtotime($event->endTime));
    		}
    		return view('event-form', ['title' => $title, 'description' => $description,
    									'startTime' => $startTime, 'endTime' => $endTime,
    									 'destination' => 'updateEvent', 'eventID' => 3]);
    	} else {
    		return redirect()->route('viewEvent', $eventID);
    	}
    }

    public function updateEvent(Request $request, $eventID){
    	if (Auth::user() !== null and Auth::user()->privilege() === 1){
    		$this->validator($request->all())->validate();
    		$event = Event::where('id', $eventID)->first();
    		if ($event !== null){
    			$event->title = $request->title;
    			$event->description = $request->description;
    			$event->startTime = date('Y-m-d\TH:i',strtotime($request->startTime));
    			$event->endTime = date('Y-m-d\TH:i',strtotime($request->endTime));
    			$event->save();
    		}
    	}
    	return redirect()->route('viewEvent', $eventID);
    }

    public function deleteEvent($eventID){
    	if (Auth::user() !== null and Auth::user()->privilege() === 1){
    		$event = Event::where('id', $eventID)->first();
    		if ($event !== null){
    			$event->delete();
    		}
    	}
    	return $this->viewCalendar();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|max:255',
            'description' => 'required|max:65535',
            'startTime' => 'required|date',
            'endTime' => 'required|date',
        ]);
    }

    protected function makeCalendar(){
    	$calendarEvents = [];
    	$DBEvents = Event::all();

    	foreach ($DBEvents as $event) {
    		$calendarEvents[] = Calendar::event(
    				$event->title,
    				false,
    				$event->startTime,
    				null,
    				$event->id,
    				[
    					'url' => route('viewEvent', $event->id),
    				]
    			);
    	}

    	$calendar = Calendar::addEvents($calendarEvents)
    				->setOptions([
				    		'header' => [
					            'left' => 'prev,next today',
					            'center' => 'title',
					            'right' => 'listYear,month',
					        ],
					        'defaultView' => 'listYear',
					]);
		return $calendar;
    }
}
