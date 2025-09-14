<?php
    /**
     * ******* Test step ******* 
     */
    require __DIR__.'/../vendor/autoload.php';
    use App\View\Components\Button;
    use App\View\Components\DialogBox;
    echo '<p>sijasijasdijasldasoidsdjsdvnsdij</p>';
    $button = new Button('test');
    $button->setId('but');
    $button->render();
    $buttonClose = new Button('X');
    $buttonClose->setId('closer');
    $box = new DialogBox('none', 'test');
    $box->setId('ftest');
    $box->addChild($buttonClose);
    $box->render();
    /**
     *  ******* End of test *******
     */
?>
<script>
    let idi = document.querySelector('#but');
    let close = document.querySelector('#closer');
    idi.addEventListener('click', ()=>{
        let divi = document.querySelector('#overlay');
        divi.classList.toggle('overlay');
        divi.classList.toggle('overlay_active');
    });
    close.addEventListener('click', ()=>{
        let divi = document.querySelector('#overlay');
        divi.classList.toggle('overlay_active');
        divi.classList.toggle('overlay');
    });
</script>