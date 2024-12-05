<?php

function solve_puzzle($memory) {
    if (is_array($memory)) {
        $memory = implode('', $memory);
    }
    
    
    $mul_pattern = 'mul\((\d{1,3}),(\d{1,3})\)';
    $do_pattern = 'do\(\)';
    $dont_pattern = "don't\(\)";
    
    $pattern = "/$mul_pattern|$do_pattern|$dont_pattern/";
    
    preg_match_all($pattern, $memory, $matches, PREG_SET_ORDER);
    
    $total = 0;
    $enabled = true;
    
    foreach ($matches as $match) {
        if ($match[0] == 'do()') {
            $enabled = true;
        } elseif ($match[0] == "don't()") {
            $enabled = false;
        } elseif ($enabled) {
            $x = intval($match[1]);
            $y = intval($match[2]);
            $total += $x * $y;
        }
    }
    
    return $total;
}


$memory = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$result = solve_puzzle($memory);
echo "The sum of all enabled multiplication results is: $result\n";

?>