<?php
    require __DIR__.'/../vendor/autoload.php';
    use App\View\Components\Button;
    use App\View\Components\FirstCover;
    /**
     * ****** Test step ******
     */

    $coverTest = new FirstCover();
    $buttonChild = new Button('CoverChild');

    $coverTest->addChild($buttonChild);
    $coverTest->addChild($buttonChild);
    $coverTest->addChild($buttonChild);
    $coverTest->addChild($buttonChild);
    $coverTest->addChild($buttonChild);

    $coverTest->render();

    /**
     * ****** End of Test ******
     */
?>