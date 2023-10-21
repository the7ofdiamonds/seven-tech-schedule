<?php

namespace SEVEN_TECH_Schedule\API\Google;

use SEVEN_TECH_Schedule\API\Google\GoogleCalendar;
use SEVEN_TECH_Schedule\API\Calendar;
use SEVEN_TECH_Schedule\API\Event;
use SEVEN_TECH_Schedule\API\Schedule;

use Google\Client;
use Google\Service\Calendar as GCalendar;

class Google
{
    private $credentialsPath;
    private $client;

    public function __construct($credentialsPath)
    {
        $this->credentialsPath = $credentialsPath;
        $this->client = new Client();
        $this->client->setApplicationName('Your Application Name');
        $this->client->setScopes(GCalendar::CALENDAR_EVENTS);
        $this->client->setAuthConfig($this->credentialsPath);
        $this->client->setScopes('https://www.googleapis.com/auth/calendar');

        new GoogleCalendar($this->client);
        new Calendar($this->client);
        new Event($this->client);
        new Schedule($this->client);
    }
}
