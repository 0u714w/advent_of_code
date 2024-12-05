<?php

function parse_input($input) {
    list($rules_section, $updates_section) = explode("\n\n", trim($input));
    $rules = array_map('trim', explode("\n", $rules_section));
    $updates = array_map('trim', explode("\n", $updates_section));
    return [$rules, $updates];
}

function build_graph($rules) {
    $graph = [];
    foreach ($rules as $rule) {
        list($before, $after) = explode('|', $rule);
        if (!isset($graph[$before])) {
            $graph[$before] = [];
        }
        $graph[$before][] = $after;
    }
    return $graph;
}

function is_valid_update($update, $graph) {
    $pages = explode(',', $update);
    $positions = array_flip($pages);
    foreach ($graph as $before => $afters) {
        if (isset($positions[$before])) {
            foreach ($afters as $after) {
                if (isset($positions[$after]) && $positions[$before] > $positions[$after]) {
                    return false;
                }
            }
        }
    }
    return true;
}

function find_middle_page($update) {
    $pages = explode(',', $update);
    $middle_index = floor(count($pages) / 2);
    return $pages[$middle_index];
}

function sum_middle_pages($input) {
    list($rules, $updates) = parse_input($input);
    $graph = build_graph($rules);
    $sum = 0;
    foreach ($updates as $update) {
        if (is_valid_update($update, $graph)) {
            $sum += find_middle_page($update);
        }
    }
    return $sum;
}

$input = file_get_contents('input.txt');

echo "Sum of middle pages: " . sum_middle_pages($input) . "\n";

?>