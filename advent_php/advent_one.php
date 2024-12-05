<?php

function calculate_total_distance($left_list, $right_list) {
    sort($left_list);
    sort($right_list);
    $total_distance = 0;
    for ($i = 0; $i < count($left_list); $i++) {
        $total_distance += abs($left_list[$i] - $right_list[$i]);
    }
    return $total_distance;
}

function calculate_similarity_score($left_list, $right_list) {
    $right_counter = array_count_values($right_list);
    $similarity_score = 0;
    foreach ($left_list as $num) {
        $similarity_score += $num * (isset($right_counter[$num]) ? $right_counter[$num] : 0);
    }
    return $similarity_score;
}

$file = fopen('index.txt', 'r');
$left_list = [];
$right_list = [];

while (($line = fgets($file)) !== false) {
    $parts = preg_split('/\s+/', trim($line));
    if (count($parts) == 2) {
        list($left, $right) = array_map('intval', $parts);
        $left_list[] = $left;
        $right_list[] = $right;
    }
}
fclose($file);

$distance_result = calculate_total_distance($left_list, $right_list);
$similarity_result = calculate_similarity_score($left_list, $right_list);

echo "The total distance between the lists is: " . $distance_result . "\n";
echo "The similarity score between the lists is: " . $similarity_result . "\n";

?>