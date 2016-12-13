<?php

ini_set('memory_limit', -1);

const G1 = 1; // polonium generator
const G2 = 2; // thulium generator
const G3 = 3; // promethium generator
const G4 = 4; // ruthenium generator
const G5 = 5; // cobalt generator
const G6 = 6; // elerium generator
const G7 = 7; // dilithium generator

const M1 = 19; // polonium-compatible microchip
const M2 = 18; // thulium-compatible microchip
const M3 = 17; // promethium-compatible microchip
const M4 = 16; // ruthenium-compatible microchip
const M5 = 15; // cobalt-compatible microchip
const M6 = 14; // elerium-compatible microchip
const M7 = 13; // dilithium-compatible microchip

$state = [
    'floors' => [
        0 => [G1, G2, G3, G4, G5, G6, G7, M7, M6, M5, M4, M2],
        1 => [M3, M1],
        2 => [],
        3 => [],
    ],
    'e' => 0,
    'steps' => 0,
];

$states = [$state];
$passedStates = [];

while (true) {
    foreach ($states as $offset => $state) {
        $newStates = [];
        $floor = $state['e'];
        $nFloor = $floor + 1;
        $pFloor = $floor - 1;
        $cFloorData = $state['floors'][$floor];
        $nFloorData = $state['floors'][$floor + 1] ?? NULL;
        $pFloorData = $state['floors'][$floor - 1] ?? NULL;

        // Can go up ?
        if ($floor < 3) {
            foreach (getPossibleCombinations($cFloorData) as $comb) {
                if (
                    !isSafe($new = array_merge($nFloorData, $comb))
                    || !isSafe($old = array_diff($cFloorData, $comb))
                ) continue;

                sort($old);
                sort($new);

                $newState = $state;
                $newState['floors'][$floor] = $old;
                $newState['floors'][$nFloor] = $new;
                $newState['e'] = $nFloor;
                $newState['steps']++;

                $hash = json_encode($newState['floors']);

                if (!empty($passedStates[$hash])) continue;
                $passedStates[$hash] = true;

                if (count($newState['floors'][3]) === 14) {
                    echo 'Steps: ' . $newState['steps'] . PHP_EOL;
                    exit;
                }
                $newStates[] = $newState;
            }
        }

        // Can go down ?
        if (
            $floor > 0
            && !($pFloor == 0 && empty($pFloorData))
            && !($pFloor == 1 && empty($pFloorData) && empty($state['floors'][$pFloor - 1]))
        ) {
            foreach ($cFloorData as $item) {
                if (
                    !isSafe($new = array_merge($pFloorData, [$item]))
                    || !isSafe($old = array_diff($cFloorData, [$item]))
                ) continue;

                sort($old);
                sort($new);

                $newState                    = $state;
                $newState['floors'][$floor]  = $old;
                $newState['floors'][$pFloor] = $new;
                $newState['e']               = $pFloor;
                $newState['steps']++;

                $hash = json_encode($newState['floors']);

                if (!empty($passedStates[$hash])) continue;
                $passedStates[$hash] = true;

                $newStates[] = $newState;
            }
        }

        if (!empty($newStates)) {
            array_splice($states, $offset, 1, $newStates);
        }
    }
}

function getPossibleCombinations(array $elements)
{
    for ($i = 0, $len = count($elements); $i < $len - 1; $i++)
        for ($j = $i + 1; $j < $len; $j++)
            yield [$elements[$i], $elements[$j]];
}

function isSafe(array $floor)
{
    $g = $m = [];

    foreach ($floor as $item) {
        if ($item < 11) $g[] = $item;
        else $m[] = $item;
    }

    if (empty($g)) return true;

    foreach ($m as $item) {
        if (!in_array(20 - $item, $floor)) return false;
    }

    return true;
}