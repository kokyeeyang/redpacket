<?php

// minimum amount >= 0.01;
// amount that sender sends out must not be be more than what he has
// amount - what the sender sends out
// quantity - how many people is he sending to
// random - how the amount is divided

function sendRedPacket($floatAmount, $intQuantity, $boolRandom, $senderId){
    
    //a mock 'db' representing the users currently in the system now
    $arrayOfCurrentUsers = [['id'=>0, 'name'=>'Ali', 'amount'=>10000], 
    ['id'=>1, 'name'=>'Abu', 'amount'=>20000], ['id'=>2, 'name'=>'John', 'amount'=>40000], 
    ['id'=>3, 'name'=>'Ahmad', 'amount'=>50000], ['id'=>4, 'name'=>'Sam', 'amount'=>50000], 
    ['id'=>5, 'name'=>'Jane', 'amount'=>200]];
    
    if($intQuantity > count($arrayOfCurrentUsers)){
        echo "There aren't that many users in this system, please lower your number of red packets";
        die();
    }
    
    $senderAmount = '';
    
    foreach($arrayOfCurrentUsers as $key => $arrayOfCurrentUser){
        if($senderId === $arrayOfCurrentUser['id']){
            $senderAmount = $arrayOfCurrentUser['amount'];
            //get rid of the sender's array so that wont send to himself
            unset($arrayOfCurrentUsers[$key]);
        } 
        
    }

    if($senderAmount === ''){
        echo 'sender id does not exist, please try again';
        die();
    }
    
    if($floatAmount < 0.01){
        echo "Input amount is too little, please try with larger amount";
    } else if ($floatAmount > $senderAmount){
        echo "Sender does not have that much money, please try again";
        die();
    }
    
    (float)$amountReceivedPerUser = $floatAmount / $intQuantity;
    //pick out random users to accept the redpacket
    $receivingUserIds = array_rand($arrayOfCurrentUsers, $intQuantity);
    $userIdArray = [];
    $userNameArray = [];
    
    foreach($arrayOfCurrentUsers as $key => $arrayOfCurrentUser){
        if((bool)$boolRandom === false){
            if(in_array($arrayOfCurrentUser['id'], $receivingUserIds)){
                echo "User" . $arrayOfCurrentUser['id'] . 
                " receives " . $amountReceivedPerUser . "\r\n";  
            }
        } else if ((bool)$boolRandom === true){
            $redPacketAmount = generateRandomNumbers($floatAmount, $intQuantity);
            if(in_array($arrayOfCurrentUser['id'], $receivingUserIds)){
                array_push($userIdArray, $arrayOfCurrentUser['id']);
                array_push($userNameArray, $arrayOfCurrentUser['name']);
            }
            
        }
    }
    
    if ((bool)$boolRandom === true){
        for($i = 0; $i < $intQuantity; $i++){
            echo "User with id = " . $userIdArray[$i] . " and name = " . $userNameArray[$i] .
            " receives " . $redPacketAmount[$i] . "\r\n";
        }
    }
    
}

function generateRandomNumbers($max, $count)
{
    $numbers = [];

    for ($i = 1; $i < $count; $i++) {
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

sendRedPacket(1000, 3, true, 0);