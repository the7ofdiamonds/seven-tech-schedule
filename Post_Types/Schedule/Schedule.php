<?php

namespace SEVEN_TECH_Schedule\Post_Types\Schedule;

use Exception;

class Schedule
{
    public function __construct()
    {
    }

    function getTeam()
    {
        $team = [];
        $users = get_users(array(
            'role__in' => array(
                'team member'
            )
        ));

        if ($users) {
            foreach ($users as $user) {
                $user_data = get_userdata($user->ID);

                $team_member = array(
                    'id' => $user_data->ID,
                    'first_name' => $user_data->first_name,
                    'last_name' => $user_data->last_name,
                    'email' => $user_data->user_email,
                    'role' => $user_data->roles,
                    'author_url' => $user_data->user_url,
                    'avatar_url' => get_avatar_url($user_data->ID, ['size' => 384])
                );

                $team[] = $team_member;
            }

            return $team;
        } else {
            throw new Exception("No Team Members found.", 404);
        }
    }
}
