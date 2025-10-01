<!DOCTYPE html>
<head>
    <?php
        require __DIR__.'/../vendor/autoload.php';
        use App\Enums\IconLoader;
        use App\View\Components\IconicButton;
        use App\View\Template\StyleCaller;
        $adder = new StyleCaller();
        $adder->callAllStyles();
        $adder->render();
    ?>
</head>
<?php

    /**
     * ****** Test step ******
     */

    $icon = IconLoader::BLACK_BOOK->value;
    $testIconic = new IconicButton($icon, 'Test');
    $testIconic->render();

    /**
     * ****** End of test ******
     */
?>