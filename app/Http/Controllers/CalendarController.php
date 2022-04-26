<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use App\TokenStore\TokenCache;
use App\TimeZones\TimeZones;

class CalendarController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware(['auth', 'verified']);
	}

	/**
	 * Makes the calendar using timezones and dates.
	 * 
	 * Also uses the getGraph function below.
	 */
	public function calendar()
	{
		$viewData = $this->loadViewData();

		$graph = $this->getGraph();

		// Get user's timezone set by system
		$timezone = TimeZones::getTzFromWindows($viewData['userTimeZone']);

		// Get start and end of the week
		$startOfWeek = new \DateTimeImmutable('sunday -1 week', $timezone);
		$endOfWeek = new \DateTimeImmutable('sunday', $timezone);

		$viewData['dateRange'] = $startOfWeek->format('M j, Y') . ' - ' . $endOfWeek->format('M j, Y');

		$queryParams = array(
			// Picks the start and end date of $startOfWeek and $endOfWeek and formats it
			'startDateTime' => $startOfWeek->format(\DateTimeInterface::ISO8601),
			'endDateTime' => $endOfWeek->format(\DateTimeInterface::ISO8601),
			// Only request the properties used by the app
			'$select' => 'subject,organizer,start,end',
			// Sort them by start time
			'$orderby' => 'start/dateTime',
			// Limit results to 25
			'$top' => 25
		);

		// Append query parameters to the '/me/calendarView' url
		$getEventsUrl = '/me/calendarView?' . http_build_query($queryParams);

		$events = $graph->createRequest('GET', $getEventsUrl)
			// Add the user's timezone to the Prefer header
			->addHeaders(array(
				'Prefer' => 'outlook.timezone="' . $viewData['userTimeZone'] . '"'
			))
			->setReturnType(Model\Event::class)
			->execute();

		$viewData['events'] = $events;
		return view('calendar', $viewData);
	}

	/**
	 * Builds the graph and sets a new access token.
	 */
	private function getGraph(): Graph
	{
		// Get the access token from the cache
		$tokenCache = new TokenCache();
		$accessToken = $tokenCache->getAccessToken();

		// Create a Graph client
		$graph = new Graph();
		$graph->setAccessToken($accessToken);
		return $graph;
	}

	/**
	 * Retrieves data from the new event formn on the new-event page.
	 */
	public function getNewEventForm()
	{
		$viewData = $this->loadViewData();

		return view('new-event', $viewData);
	}

	/**
	 * Creates a new event using the form retrieved above.
	 */
	public function createNewEvent(Request $request)
	{
		// Validate required fields
		$request->validate([
			'eventSubject' => 'nullable|string',
			'eventAttendees' => 'nullable|string',
			'eventStart' => 'required|date',
			'eventEnd' => 'required|date',
			'eventBody' => 'nullable|string'
		]);

		$viewData = $this->loadViewData();

		$graph = $this->getGraph();

		// Attendees from form are a semi-colon delimited list of
		// email addresses
		$attendeeAddresses = explode(';', $request->eventAttendees);

		// The Attendee object in Graph is complex, so build the structure
		$attendees = [];
		foreach ($attendeeAddresses as $attendeeAddress) {
			array_push($attendees, [
				// Add the email address in the emailAddress property
				'emailAddress' => [
					'address' => $attendeeAddress
				],
				// Set the attendee type to required
				'type' => 'required'
			]);
		}

		// Build the event
		$newEvent = [
			'subject' => $request->eventSubject,
			'attendees' => $attendees,
			'start' => [
				'dateTime' => $request->eventStart,
				'timeZone' => $viewData['userTimeZone']
			],
			'end' => [
				'dateTime' => $request->eventEnd,
				'timeZone' => $viewData['userTimeZone']
			],
			'body' => [
				'content' => $request->eventBody,
				'contentType' => 'text'
			]
		];

		// POST /me/events
		$response = $graph->createRequest('POST', '/me/events')
			->attachBody($newEvent)
			->setReturnType(Model\Event::class)
			->execute();

		return redirect('/calendar');
	}

	/**
	 * Just a simple login function if the user is not logged into the microsoft servers.
	 */
	public function login()
	{
		return view('calendar-login');
	}
}
