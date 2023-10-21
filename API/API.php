<?php

namespace SEVEN_TECH_Schedule\API;

use SEVEN_TECH_Schedule\API\Google\Google;

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

      new Google($credentialsPath);
    } else {
      error_log('A path to the Google Service Account file is required.');
    }
  }
}
