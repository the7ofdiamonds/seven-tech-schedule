<?php

namespace SEVEN_TECH_Schedule\Database;

class Database
{
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        // $this->createTables();
    }

    function createTables()
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $this->create_team_table();
    }

    function create_team_table()
    {
        $table_name = '7tech_team';
        $charset_collate = $this->wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id INT NOT NULL AUTO_INCREMENT,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            user_id VARCHAR(255) DEFAULT NULL,
            author_url VARCHAR(255) DEFAULT NULL,
            avatar_url VARCHAR(255) DEFAULT NULL,
            hacker_rank_link VARCHAR(255) DEFAULT NULL,
            linkedin_link VARCHAR(255) DEFAULT NULL,
            behance_link VARCHAR(255) DEFAULT NULL,
            github_link VARCHAR(255) DEFAULT NULL,
            PRIMARY KEY (id),
            UNIQUE KEY user_id (user_id)
        ) $charset_collate;";

        dbDelta($sql);
    }
}
