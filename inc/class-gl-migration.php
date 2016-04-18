<?php

class GL_Migration
{
    public static $db_version = 1;

    public static function check()
    {
        if ( get_site_option( 'gl_db_version' ) != self::$db_version )
            self::up();
    }

    public static function up()
    {
        global $wpdb;

        $installed_version = get_option( 'gl_db_version' );

        if ( $installed_version != self::$db_version )
        {
            $table_name = $wpdb->prefix . "locations"; 
            
            $wpdb_collate = $wpdb->collate;

            $sql = "CREATE TABLE {$table_name} (
                id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                object_name VARCHAR(50) NOT NULL DEFAULT 'post',
                object_id INT(11) UNSIGNED NOT NULL,
                lat VARCHAR(30),
                lng VARCHAR(30),
                geometry VARCHAR(61),
                street_address text,
                route varchar(80),
                intersection varchar(255),
                political varchar(255),
                country varchar(100),
                administrative_area_level_1 varchar(255),
                administrative_area_level_2 varchar(255),
                administrative_area_level_3 varchar(255),
                administrative_area_level_4 varchar(255),
                administrative_area_level_5 varchar(255),
                colloquial_area varchar(255),
                locality varchar(255),
                ward varchar(255),
                sublocality varchar(255),
                neighborhood varchar(100),
                premise varchar(150),
                subpremise varchar(150),
                postal_code varchar(15),
                natural_feature varchar(255),
                airport varchar(120),
                park varchar(120),
                point_of_interest varchar(120),
                post_box varchar(100),
                street_number varchar(10),
                floor varchar(5),
                room varchar(5),
                formatted_address text,
                location_id varchar(255),
                url VARCHAR(255),
                nearby text,
                created_at timestamp DEFAULT CURRENT_TIMESTAMP,
                updated_at timestamp,
                PRIMARY KEY  (id)
            )
            COLLATE {$wpdb_collate}";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
            update_option( 'gl_db_version', self::$db_version );
        }
    }

    public static function down()
    {
        // Do nothing
    }
}