<?php

function connect_to_database($host, $dbname, $username, $password) {
    try {
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function fetch_data_from_database($sql, $db) {
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function transform_labels_for_chart($data) {
    $labels = [];

    foreach ($data as $row) {
        $labels[] = $row['avg_date'];
    }

    return $labels;
}

function transform_values_for_chart($data) {
    $values = [];

    foreach ($data as $row) {
        $values[] = $row['avg_value'];
    }

    return $values;
}

function draw_chart($labels, $values, $type) {
    if ($type == "temperature") $title = "Температура";
    elseif ($type == "humidity") $title = "Влажность";
    else $title = "Уровень углекислого газа";
    echo '<div id = "chartContainer" style = "width: 100%; height: 50%;">';
    echo '<canvas id="myChart" width="200" height="200"></canvas>';
    echo '<script>';
    echo 'var ctx = document.getElementById("myChart").getContext("2d");';
    echo 'var myChart = new Chart(ctx, {';
    echo '    type: "line",';
    echo '    data: {';
    echo '        labels: ' . json_encode($labels) . ',';
    echo '        datasets: [{';
    echo '            label: "' . $title . '",';
    echo '            data: ' . json_encode($values) . ',';
    echo '            borderColor: "rgba(46, 39, 245, 0.8)",';
    echo '            borderWidth: 1';
    echo '        }]';
    echo '    },';
    echo '    options: {';
    echo '        scales: {';
    echo '            xAxes: [{';
    echo '                type: "time",';
    echo '                time: {';
    echo '                    unit: "hour",';
    echo '                    displayFormats: {';
    echo '                        hour: "H:mm"';
    echo '                    }';
    echo '                }';
    echo '            }]';
    echo '        }';
    echo '    }';
    echo '});';
    echo '</script>';
    echo '</div>';
}

function choose_query($period, $type){
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

function create_graph($period, $type, $db){
    $sql = choose_query($period, $type);
    $data = fetch_data_from_database($sql, $db);
    $labels = transform_labels_for_chart($data);
    $values = transform_values_for_chart($data);

    return draw_chart($labels, $values, $type);
}

?>