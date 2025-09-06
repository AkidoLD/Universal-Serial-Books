<?php
    require_once __DIR__.'/../src/component/Button.php';
    $test = new Button('Button for test');
    $test->round(8);
    $test->setBColor('green');
    $test->render();
?>