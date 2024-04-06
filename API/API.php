<?php

namespace SEVEN_TECH\Schedule\API;

use SEVEN_TECH\Schedule\API\Google\Google;

use Google\Client;
use Google\Service\Calendar as GCalendar;

class API
{
  function __construct()
  {
    $credentialsPath = SEVEN_TECH_SCHEDULE . 'serviceAccount.json';

    if (file_exists($credentialsPath)) {
      $jsonFileContents = file_get_contents($credentialsPath);

      if ($jsonFileContents !== false) {
        $decodedData = json_decode($jsonFileContents, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decodedData)) {
          if (
            isset($decodedData['type']) && $decodedData['type'] === 'service_account' &&
            isset($decodedData['project_id']) &&
            isset($decodedData['private_key_id']) &&
            isset($decodedData['private_key']) &&
            isset($decodedData['client_email'])
          ) {
            $credentialsPath = SEVEN_TECH_SCHEDULE . 'serviceAccount.json';
          } else {
            error_log('This is not a valid service account JSON');
            $credentialsPath = null;
          }
        } else {
          error_log('Failed to decode JSON');
          $credentialsPath = null;
        }
      } else {
        error_log('Failed to read file contents');
        $credentialsPath = null;
      }
    } else {
      error_log('File does not exist');
      $credentialsPath = null;
    }

    if ($credentialsPath !== null) {
      $client = new Client();
      $client->setApplicationName('Your Application Name');
      $client->setScopes(GCalendar::CALENDAR_EVENTS);
      $client->setAuthConfig($credentialsPath);
      $client->setScopes('https://www.googleapis.com/auth/calendar');
      new Google($credentialsPath);
      $schedule = new Schedule($client);
    } else {
      error_log('A path to the Google Service Account file is required.');
    }

    register_rest_route('seven-tech/v1', '/schedule/office-hours', array(
      'methods' => 'GET',
      'callback' => array($schedule, 'get_office_hours'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/schedule/available-times', array(
      'methods' => 'GET',
      'callback' => array($schedule, 'get_available_times'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/schedule/communication', array(
      'methods' => 'GET',
      'callback' => array($schedule, 'get_communication_preferences'),
      'permission_callback' => '__return_true',
    ));
  }
}
