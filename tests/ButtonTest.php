<?php
    require __DIR__.'/../vendor/autoload.php';
    use App\View\Components\Button;
    /**
     * ********** Test step **********
     */
    $test = new Button('Button for test');
    $test->render();
    /**
     * ********** End of test **********
     */
?>