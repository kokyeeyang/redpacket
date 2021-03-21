<?php

// minimum amount >= 0.01;
// amount that sender sends out must not be be more than what he has
// amount - what the sender sends out
// quantity - how many people is he sending to
// random - how the amount is divided

function sendAngPao($floatAmount, $intQuantity, $boolRandom){
    if($floatAmount < 0.01){
        echo "Input amount is too little, please try with larger amount";
        exit;
    }
    
    if((bool)$boolRandom === false){
        (float)$amountReceivedPerUser = $floatAmount / $intQuantity;
        for($i = 0; $i < $intQuantity; $i++){
            echo "User" . $i + 1 . " receives " . $amountReceivedPerUser . "\r\n";
        }
        
    } else if ((bool)$boolRandom === true){
        $redPacketAmount = generateRandomNumbers($floatAmount, $intQuantity);
        for($i = 0; $i < $intQuantity; $i++){
            echo "User" . $i + 1 . " receives " . $redPacketAmount[$i] . "\r\n";
        }
    }
    
}

function generateRandomNumbers($max, $count)
{
    $numbers = [];

    for ($i = 1; $i < $count; $i++) {
        // $random = (mt_rand(0.01, $max / ($count - $i)))/10;
        $random = frand(0.01, $max, 2);
        $numbers[] = $random;
        $max -= $random;
    }

    $numbers[] = $max;

    shuffle($numbers);

    return($numbers);
}

function frand($min, $max, $decimals = 0) {
  $scale = pow(10, $decimals);
  return mt_rand($min * $scale, $max * $scale) / $scale;
}

sendAngPao(10, 3, false);

