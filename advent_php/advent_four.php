<?php

function check_x($mat, $i, $j) {
    // Construct the string from the positions around 'A'
    $x_string = 
        $mat[$i-1][$j-1] .  // Top Left
        $mat[$i][$j] .      // Center A
        $mat[$i+1][$j+1] .  // Bottom Right
        $mat[$i-1][$j+1] .  // Top Right
        $mat[$i][$j] .      // Center A again (for symmetry)
        $mat[$i+1][$j-1];   // Bottom Left
    
   
    return in_array($x_string, ["MASMAS", "SAMSAM", "SAMMAS", "MASSAM"]);
}

function count_x_mas_patterns($mat) {
    $x_mas_count = 0;
    $rows = count($mat);
    $cols = count($mat[0]);
    
    for ($i = 1; $i < $rows - 1; $i++) {  
        for ($j = 1; $j < $cols - 1; $j++) { 
            if ($mat[$i][$j] == "A") {
                $x_mas_count += check_x($mat, $i, $j) ? 1 : 0;
            }
        }
    }
    
    return $x_mas_count;
}

function part_2($input_lines) {
    $mul_search = '/mul\(([0-9]{1,3}),([0-9]{1,3})\)/';
    
    $merged_data = implode("", array_map('trim', $input_lines));
    
    $dirty_processing = array_map(function($segment) {
        return explode("don't()", $segment)[0];
    }, explode("do()", $merged_data));
    
    preg_match_all($mul_search, implode("", $dirty_processing), $results, PREG_SET_ORDER);
    
    $sum_of_multiples = array_reduce($results, function($carry, $item) {
        return $carry + (int)$item[1] * (int)$item[2];
    }, 0);

   
    $matrix = array_map('str_split', array_filter(array_map('trim', $input_lines)));

    $x_mas_count = count_x_mas_patterns($matrix);

    return [$sum_of_multiples, $x_mas_count];
}

$input_lines = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
list($sum_of_multiples, $x_mas_count) = part_2($input_lines);

echo "Sum of multiples: " . $sum_of_multiples . "\n";
echo "X-MAS patterns count: " . $x_mas_count . "\n";

?>