<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\API\Google\GoogleCalendar;
use SEVEN_TECH\Schedule\Schedule as ORB_Schedule;

use Google\Service\Calendar\Calendar;
use Google\Service\Calendar\FreeBusyRequest;
use Google\Service\Calendar\FreeBusyRequestItem;
use Google\Service\Calendar\FreeBusyCalendar;

class Schedule
{
    private $schedule;
    private $timeZone;
    private $calendar_id;
    private $groupExpansionMax;
    private $calendarExpansionMax;
    private $google_calendar;
    private $calendar;

    public function __construct($client)
    {
        add_action('rest_api_init', function () {
            register_rest_route('orb/v1', '/schedule/office-hours', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_office_hours'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('orb/v1', '/schedule/available-times', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_available_times'),
                'permission_callback' => '__return_true',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('orb/v1', '/schedule/communication', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_communication_preferences'),
                'permission_callback' => '__return_true',
            ));
        });

        $this->schedule = new ORB_Schedule($client);
        $this->timeZone = $this->schedule->timeZone;
        $this->calendar_id = $this->schedule->calendar_id;
        $this->groupExpansionMax = $this->schedule->groupExpansionMax;
        $this->calendarExpansionMax = $this->schedule->calendarExpansionMax;

        $this->google_calendar = new GoogleCalendar($client);
        $this->calendar = new Calendar($client);
    }

    public function get_office_hours()
    {
        try {
            $office_hours = $this->schedule->getOfficeHours();

            return rest_ensure_response($office_hours);
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

    public function getHolidays()
    {
        try {
            $holidays = $this->calendar->calendar->getHolidays();

            return $holidays;
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

    public function get_available_times(WP_REST_Request $request)
    {
        try {
            $asSoon = $this->schedule->asSoon;
            $earliestTime = $this->schedule->earliestTime;
            $asFar = $this->schedule->asFar;
            $latestTime = $this->schedule->latestTime;

            $today = date("Y-m-d");
            $earliestDate = date("Y-m-d", strtotime($asSoon, strtotime($today)));
            $latestDate = date("Y-m-d", strtotime($asFar, strtotime($earliestDate)));

            $timeMin = $earliestDate . 'T' . $earliestTime . 'Z';
            $timeMax = $latestDate . 'T' . $latestTime . 'Z';

            $calendars = $this->google_calendar->getCalendars();
            $items = $calendars->getItems();

            $requestItems = [];

            foreach ($items as $item) {
                $requestItems[] = ['id' => $item['id']];
            }

            $postBody = new FreeBusyRequest([
                "timeMin" => $timeMin,
                "timeMax" => $timeMax,
                "timeZone" => $this->timeZone,
                "groupExpansionMax" => $this->groupExpansionMax,
                "calendarExpansionMax" => $this->calendarExpansionMax,
                "items" => $requestItems
            ]);

            $availableTimes = $this->schedule->getAvailableTimes($postBody);

            return rest_ensure_response($availableTimes);
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

    function get_communication_preferences()
    {
        try {
            global $wpdb;

            $communication_types = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT * FROM orb_communication_types",
                )
            );

            if (!$communication_types) {
                throw new Exception('No Communication Types found', 404);
            }

            return rest_ensure_response($communication_types);
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
}
