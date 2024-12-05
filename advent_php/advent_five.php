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

function topological_sort($graph) {
    $in_degree = [];
    $zero_in_degree = [];
    $sorted = [];

    foreach ($graph as $node => $edges) {
        if (!isset($in_degree[$node])) {
            $in_degree[$node] = 0;
        }
        foreach ($edges as $edge) {
            if (!isset($in_degree[$edge])) {
                $in_degree[$edge] = 0;
            }
            $in_degree[$edge]++;
        }
    }

    foreach ($in_degree as $node => $degree) {
        if ($degree == 0) {
            $zero_in_degree[] = $node;
        }
    }

    while (!empty($zero_in_degree)) {
        $node = array_pop($zero_in_degree);
        $sorted[] = $node;
        if (isset($graph[$node])) {
            foreach ($graph[$node] as $edge) {
                $in_degree[$edge]--;
                if ($in_degree[$edge] == 0) {
                    $zero_in_degree[] = $edge;
                }
            }
        }
    }

    return $sorted;
}

function correct_update($update, $graph) {
    $pages = explode(',', $update);
    $subgraph = [];
    foreach ($pages as $page) {
        if (isset($graph[$page])) {
            $subgraph[$page] = array_intersect($graph[$page], $pages);
        }
    }
    $sorted_pages = topological_sort($subgraph);
    return implode(',', array_intersect($sorted_pages, $pages));
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

function sum_middle_pages_incorrect($input) {
    list($rules, $updates) = parse_input($input);
    $graph = build_graph($rules);
    $sum = 0;
    foreach ($updates as $update) {
        if (!is_valid_update($update, $graph)) {
            $corrected_update = correct_update($update, $graph);
            $sum += find_middle_page($corrected_update);
        }
    }
    return $sum;
}

// Load input from file
$input = file_get_contents('input.txt');

echo "Sum of middle pages (correctly ordered updates): " . sum_middle_pages($input) . "\n";
echo "Sum of middle pages (incorrectly ordered updates corrected): " . sum_middle_pages_incorrect($input) . "\n";

?>