<?php
require_once __DIR__ . "/helpers.php";
require_once __DIR__ . "/db.php";

function draw_chart($labels, $values, $type)
{
    if ($type == "temperature")
        $title = "Температура";
    elseif ($type == "humidity")
        $title = "Влажность";
    else
        $title = "Уровень углекислого газа";

    // Установка размеров канваса напрямую через атрибуты
    $canvasWidth = 800; // Ширина канваса
    $canvasHeight = 400; // Высота канваса

    echo '<div id="chartContainer">';
    echo "<canvas id=\"myChart\" width=\"$canvasWidth\" height=\"$canvasHeight\"></canvas>";
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
    echo '        responsive: true,';
    echo '        maintainAspectRatio: false,';
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

function create_graph($period, $type, $db)
{
    $sql = choose_query($period, $type);
    $data = fetch_data_from_database($sql, $db);
    $labels = transform_labels_for_chart($data);
    $values = transform_values_for_chart($data);

    return draw_chart($labels, $values, $type);
}
?>
