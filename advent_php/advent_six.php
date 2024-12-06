<?php

function countGuardPositions($map) {
    $rows = count($map);
    $cols = strlen($map[0]);
    $visited = array();
    $directions = array('^' => [-1, 0], '>' => [0, 1], 'v' => [1, 0], '<' => [0, -1]);
    $dirOrder = array('^' => '>', '>' => 'v', 'v' => '<', '<' => '^');


    $x = $y = $dir = null;
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            if (strpos('^>v<', $map[$i][$j]) !== false) {
                $y = $i;
                $x = $j;
                $dir = $map[$i][$j];
                break 2;
            }
        }
    }

    while (true) {
       
        $visited["$y,$x"] = true;

        $nextY = $y + $directions[$dir][0];
        $nextX = $x + $directions[$dir][1];

        if ($nextY < 0 || $nextY >= $rows || $nextX < 0 || $nextX >= $cols) {
            
            break;
        }

        if ($map[$nextY][$nextX] == '#') {
           
            $dir = $dirOrder[$dir];
        } else {
            
            $y = $nextY;
            $x = $nextX;
        }
    }

    return count($visited);
}

$map = file('input.txt', FILE_IGNORE_NEW_LINES);

$result = countGuardPositions($map);
echo "The guard visited $result distinct positions.\n";

?>