<?php

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