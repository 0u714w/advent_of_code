<?php

function is_safe($levels) {
    if (count($levels) < 2) {
        return true;
    }
    
    $diff = $levels[1] - $levels[0];
    if (abs($diff) < 1 || abs($diff) > 3) {
        return false;
    }
    
    for ($i = 2; $i < count($levels); $i++) {
        $new_diff = $levels[$i] - $levels[$i-1];
        if ($new_diff * $diff <= 0 || abs($new_diff) < 1 || abs($new_diff) > 3) {
            return false;
        }
        $diff = $new_diff;
    }
    
    return true;
}

function count_safe_reports($data) {
    $safe_count = 0;
    $lines = explode("\n", trim($data));
    foreach ($lines as $line) {
        $levels = array_map('intval', explode(' ', $line));
        if (is_safe($levels)) {
            $safe_count += 1;
        }
    }
    return $safe_count;
}

$data = file_get_contents('input.txt');
$result = count_safe_reports($data);
echo "Number of safe reports: $result\n";

?>