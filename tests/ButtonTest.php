<?php
    use App\View\Components\Button;
    require __DIR__.'/../vendor/autoload.php';
    /**
     * ********** Test step **********
     */
    $test = new Button('Button for test');
    $test->round(8);
    $test->setBColor('green');
    $test->setTColor('white');
    $test->render();
    $test->disable();
    $test->setBorder('red', 2);
    $test->disable();
    $test->enable();
    $test->setSize(100, 200);
    /**
     * ********** End of test **********
     */
?>