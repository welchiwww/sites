<?php
require_once "../configs/conf.php";

//Для работы с БД, а так же для выбора запроса

function connect_to_database() : PDO {
    try {
        $db = new PDO('pgsql:host=' . DB_HOST .';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function choose_query(string $period, string $type) : string {
    switch ($period) {
        case 'hour':
            $sql = "SELECT reading_time as avg_date, $type as avg_value
                    FROM sensor_data 
                    ORDER BY reading_time DESC 
                    LIMIT 61";
            break;
        case 'day':
            $sql = "SELECT
                        date_trunc('hour', reading_time) AS avg_date,
                        AVG($type) AS avg_value
                    FROM
                        public.sensor_data
                    WHERE
                        reading_time >= NOW() - INTERVAL '1 day'
                    GROUP BY
                        avg_date
                    ORDER BY
                        avg_date;
                    ";
            break;        
        case 'month':
            $sql = "SELECT
                        date_trunc('day', reading_time) AS avg_date,
                        AVG($type) AS avg_value
                    FROM
                        public.sensor_data
                    WHERE
                        reading_time >= NOW() - INTERVAL '1 month'
                    GROUP BY
                        avg_date
                    ORDER BY
                        avg_date;
                        ";
            break;
        default:
            $sql = "SELECT reading_time as avg_date, $type as avg_value FROM sensor_data";
            break;
    }
    return $sql;
}

function fetch_data_from_database(string $sql, PDO $db) {
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}