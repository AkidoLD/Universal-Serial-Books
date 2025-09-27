<?php

require_once __DIR__."/../bootstrap.php";

function testArgs($arg){
    echoPre();
    var_dump($arg);
    echoPre();
}

$arguments = [1,2,3,4,5];

testArgs(...$arguments);