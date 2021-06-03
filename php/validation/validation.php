<?php

function valid_data($data): string {
    $data = trim($data);
    return htmlspecialchars($data);
}

function valid_data_to_display($data): string {
    $data = html_entity_decode($data);
    return $data = htmlspecialchars($data);
}