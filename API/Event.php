<?php

namespace SEVEN_TECH\API;

use Exception;
use DateTime;
use WP_REST_Request;

use SEVEN_TECH\Database\DatabaseEvent;
use SEVEN_TECH\API\Google\GoogleCalendar;
use SEVEN_TECH\Schedule\Schedule;

use Google\Service\Calendar\Event as CalendarEvent;

class Event
{
    private $event_database;
    private $google_calendar;
    private $calendar_id;
    private $schedule;

    public function __construct($client)
    {
        add_action('rest_api_init', function () {
            register_rest_route('orb/v1', '/event', array(
                'methods' => 'POST',
                'callback' => array($this, 'create_event'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('orb/v1', '/event/(?P<slug>[a-zA-Z0-9-_]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_event'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('orb/v1', '/events', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_events'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('orb/v1', '/events/client/(?P<slug>[a-zA-Z0-9-_]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_events_by_client_id'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('orb/v1', '/event/(?P<slug>[a-zA-Z0-9-_]+)', array(
                'methods' => 'PUT',
                'callback' => array($this, 'update_event'),
                'permission_callback' => '__return_true',
            ));
        });

        global $wpdb;
        $this->event_database = new DatabaseEvent($wpdb);
        $this->google_calendar = new GoogleCalendar($client);
        $this->schedule = new Schedule($client);

        $this->calendar_id = $this->schedule->calendar_id;
    }

    public function create_event(WP_REST_Request $request)
    {
        try {
            error_log($request['description']);

            if (
                empty($request['client_id']) ||
                empty($request['start']) ||
                empty($request['start_date']) ||
                empty($request['start_time']) ||
                empty($request['attendees'])
            ) {
                throw new Exception('Invalid event data.');
            }

            $clientId = $request['client_id'];
            $dateTime = $request['start'];
            $startDate = $request['start_date'];
            $startTime = $request['start_time'];
            $attendees = $request['attendees'];
            $summary = $request['summary'];
            $description = $request['description'];

            if (empty($this->calendar_id)) {
                throw new Exception('A Google Calendar ID is required.');
            } else if (empty($clientId)) {
                throw new Exception('A Client ID is required.');
            } else if (empty($dateTime)) {
                throw new Exception('A date time is required.');
            } else if (empty($startDate)) {
                throw new Exception('A start date is required.');
            } else if (empty($startTime)) {
                throw new Exception('A start time is required.');
            } else if (empty($attendees)) {
                throw new Exception('Attendees are required.');
            } else if (empty($summary)) {
                throw new Exception('A summary is required.');
            } else if (empty($description)) {
                throw new Exception('A desciption is required.');
            }

            $start = $request['start'];
            $event_duration_hours = intval(get_option('orb_event_duration_hours'));
            $event_duration_minutes = intval(get_option('orb_event_duration_minutes'));

            $end = new DateTime($start);
            $end->modify('+' . $event_duration_hours . ' hours');
            $end->modify('+' . $event_duration_minutes . ' minutes');

            $timeZone = get_option('orb_event_time_zone');

            $event = new CalendarEvent(array(
                'summary' => $summary,
                'description' => $description,
                'start' => array(
                    'dateTime' => $start,
                    'timeZone' => $timeZone,
                ),
                'end' => array(
                    'dateTime' => $end->format('Y-m-d\TH:i:s'),
                    'timeZone' => $timeZone,
                ),
                'attendees' => array_map(function ($email) {
                    return array('email' => $email);
                }, $request['attendees']),
                'transparency' => 'opaque',
                'visibility' => 'default',
                'status' => 'confirmed',
            ));

            $createdEvent = $this->google_calendar->createCalendarEvent($this->calendar_id, $event);

            $event_id = $this->event_database->saveEvent($clientId, $createdEvent);

            return rest_ensure_response($event_id);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $status_code = $e->getCode();

            $response_data = [
                'message' => $error_message,
                'status' => $status_code
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
    }

    public function get_event(WP_REST_Request $request)
    {
        try {
            $id = $request->get_param('slug');

            if (empty($id)) {
                throw new Exception('Event ID is required.');
            }

            if (empty($this->calendar_id)) {
                throw new Exception('Calendar ID is required.');
            }

            $event = $this->event_database->getEvent($id);
            $event_id = $event['google_event_id'];
            $event = $this->google_calendar->getCalendarEvent($this->calendar_id, $event_id);

            return rest_ensure_response($event);
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $message = [
                'message' => $msg,
            ];
            $response = rest_ensure_response($message);
            $response->set_status(404);

            return $response;
        }
    }

    public function get_events(WP_REST_Request $request)
    {
        try {
            $request_body = $request->get_body();
            $body = json_decode($request_body, true);
            $calendar_id = !empty($body['calendar_id']) ? $body['calendar_id'] : $this->calendar_id;

            if (empty($calendar_id) && empty($this->calendar_id)) {
                throw new Exception('Calendar ID is required.');
            }

            $optParams = [];
            $events = $this->google_calendar->getCalendarEvents($calendar_id, $optParams = []);

            return rest_ensure_response($events);
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $message = [
                'message' => $msg,
            ];
            $response = rest_ensure_response($message);
            $response->set_status(404);

            return $response;
        }
    }

    public function get_events_by_client_id(WP_REST_Request $request)
    {
        $client_id = $request->get_param('slug');

        if (empty($client_id)) {
            return rest_ensure_response('invalid_client_id', 'Invalid Client ID', array('status' => 400));
        }

        $events = $this->event_database->getEventsByClientID($client_id);

        return rest_ensure_response($events);
    }

    function update_event()
    {
    }
}
