<?php

$distance = 20;
$maxStep = 3;
$minStep = 1;
$actionSpeed = 1;
$players = explode(" ", readline("enter your players: "));
$track = [];

for ($i = 0; $i < count($players); $i++) {
    $track[$i] = array_fill(0, $distance, "-");
    $track[$i][0] = $players[$i];
}
echo "WELCOME! PLACE A BET ON YOUR HORSE!" . PHP_EOL;
foreach ($track as $line) {
    echo implode("", $line) . PHP_EOL;
}
$yourBet = (int)(readline("enter sum to bet: "));
$yourChoice = readline("Choose your horse's name: ");
echo "You placed $yourBet on $yourChoice" . PHP_EOL;
echo "Let's start the race! Good luck!" . PHP_EOL;

$finishers = [];
while (count($finishers) < count($players)) {
    //system("clear");
    echo "\e[H\e[J";
    for ($i = 0; $i < count($players); $i++) {
        $currentPosition = array_search($players[$i], $track[$i]);
        if ($currentPosition === false) continue;

        $step = rand($minStep, $maxStep);
        $nextPosition = $currentPosition + $step;
        if ($nextPosition > $distance - 1) {
            $nextPosition = $distance - 1;
        }
        if (!in_array($players[$i], $finishers)) {
            $track[$i][$nextPosition] = $players[$i];
            $track[$i][$currentPosition] = "-";
        }
        if ($nextPosition === $distance - 1 && !in_array($players[$i], $finishers)) {
            $finishers[] = $players[$i];
        }

    }
    foreach ($track as $line) {
        echo implode("", $line) . PHP_EOL;
    }

    sleep($actionSpeed);

}

foreach ($finishers as $place => $finisher) {
    $place = $place + 1;
    echo "# $place - $finisher" . PHP_EOL;
}
if ($finishers[0] === $yourChoice) {
    $win = $yourBet * 3;
    echo "Congratz! You won $win";
}
else if ($finishers[1] === $yourChoice) {
    $win = $yourBet * 2;
    echo "Congratz! You won $win";
}
else if ($finishers[2] === $yourChoice) {
    $win = $yourBet;
    echo "Congratz! You won $win";
} else {
    echo "Bad luck! Your horse wasn't in top 3";
}
