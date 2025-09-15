<?php
    require __DIR__.'/../vendor/autoload.php';
    use App\View\Components\Button;
    /**
     * ********** Test step **********
     */
    $test = new Button('Button test');
    $test->render();
    /**
     * ********** End of test **********
     */
?>