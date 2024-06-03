<?php

function transform_labels_for_chart(array $data) : array {
    $labels = [];

    foreach ($data as $row) {
        $labels[] = $row['avg_date'];
    }

    return $labels;
}

function transform_values_for_chart(array $data) : array {
    $values = [];

    foreach ($data as $row) {
        $values[] = $row['avg_value'];
    }

    return $values;
}