<?php
    /**
     * ******* Test step ******* 
     */
    require __DIR__.'/../vendor/autoload.php';
    use App\View\Components\Button;
    use App\View\Components\DialogBox;
    echo '<p>Test step on dialog boxes</p>';

    $button = new Button('test');
    $button->setId('but');
    $button->render();

    $buttonClose = new Button('X');
    $buttonClose->setId('closer');

    $box = new DialogBox('none', 'test');
    $box->setId('ftest');
    $box->setContent("Just to test, i introduce a lot of words without a specific value :
    ijijoijijoijiojooijooijooijoijoij
    isdoifhaddsfjijfadsifjasdpofjsadfposdjosdjfdspo
    asiodfjisdjfisdaoifjoasidjfaoifjsdifjasoid
    saidofjsdifsdnsnvdijfasi;odjf
    sdifj ijsdioji jo ijisjiojfi jijoijdfij ijfdoisjijsdfio
    ijijsdidj ijdsijfsdpojsdpovneiijew83u9084eiowdn
    io ijewoijfpeif39p23p0f'e0ewniojiejf9u0v jpef94w0eudisclijdio9
    weu90wuerjcnklsdifjwow48efodsijdkekdefwji
    jfdspo
    asiodfjisdjfisdaoifjoasidjfaoifjsdifjasoid
    saidofjsdifsdnsnvdijfasi;odjf
    sdifj ijsdioji jo ijisjiojfi jijoijdfij ijfdoisjijsdfio
    ijijsdidj ijdsijfsdpojsdpovneiijew83u9084eiowdn
    io ijewoijfpeif39p23p0f'e0ewniojiejf9u0v jpef94w0eudisclijdio9
    weu90wuerjcnklsdifjwow48efodsijdkekdefwji
    v
    isdoifhaddsfjijfadsifjasdpofjsadfposdjosdjfdspo
    asiodfjisdjfisdaoifjoasidjfaoifjsdifjasoid
    saidofjsdifsdnsnvdijfasi;odjf
    sdifj ijsdioji jo ijisjiojfi jijoijdfij ijfdoisjijsdfio
    ijijsdidj ijdsijfsdpojsdpovneiijew83u9084eiowdn
    io ijewoijfpeif39p23p0f'e0ewniojiejf9u0v jpef94w0eudisclijdio9
    weu90wuerjcnklsdifjwow48efodsijdkekdefwji
    jfdspo
    asiodfjisdjfisdaoifjoasidjfaoifjsdifjasoid
    saidofjsdifsdnsnvdijfasi;odjf
    sdifj ijsdioji jo ijisjiojfi jijoijdfij ijfdoisjijsdfio
    ijijsdidj ijdsijfsdpojsdpovneiijew83u9084eiowdn
    io ijewoijfpeif39p23p0f'e0ewniojiejf9u0v jpef94w0eudisclijdio9
    weu90wuerjcnklsdifjwow48efodsijdkekdefwji
    isdoifhaddsfjijfadsifjasdpofjsadfposdjosdjfdspo
    asiodfjisdjfisdaoifjoasidjfaoifjsdifjasoid
    saidofjsdifsdnsnvdijfasi;odjf
    sdifj ijsdioji jo ijisjiojfi jijoijdfij ijfdoisjijsdfio
    ijijsdidj ijdsijfsdpojsdpovneiijew83u9084eiowdn
    io ijewoijfpeif39p23p0f'e0ewniojiejf9u0v jpef94w0eudisclijdio9
    weu90wuerjcnklsdifjwow48efodsijdkekdefwji
    jfdspo
    asiodfjisdjfisdaoifjoasidjfaoifjsdifjasoid
    saidofjsdifsdnsnvdijfasi;odjf
    sdifj ijsdioji jo ijisjiojfi jijoijdfij ijfdoisjijsdfio
    ijijsdidj ijdsijfsdpojsdpovneiijew83u9084eiowdn
    io ijewoijfpeif39p23p0f'e0ewniojiejf9u0v jpef94w0eudisclijdio9
    weu90wuerjcnklsdifjwow48efodsijdkekdefwji
    isdoifhaddsfjijfadsifjasdpofjsadfposdjosdjfdspo
    asiodfjisdjfisdaoifjoasidjfaoifjsdifjasoid
    saidofjsdifsdnsnvdijfasi;odjf
    sdifj ijsdioji jo ijisjiojfi jijoijdfij ijfdoisjijsdfio
    ijijsdidj ijdsijfsdpojsdpovneiijew83u9084eiowdn
    io ijewoijfpeif39p23p0f'e0ewniojiejf9u0v jpef94w0eudisclijdio9
    weu90wuerjcnklsdifjwow48efodsijdkekdefwji
    jfdspo
    asiodfjisdjfisdaoifjoasidjfaoifjsdifjasoid
    saidofjsdifsdnsnvdijfasi;odjf
    sdifj ijsdioji jo ijisjiojfi jijoijdfij ijfdoisjijsdfio
    ijijsdidj ijdsijfsdpojsdpovneiijew83u9084eiowdn
    io ijewoijfpeif39p23p0f'e0ewniojiejf9u0v jpef94w0eudisclijdio9
    weu90wuerjcnklsdifjwow48efodsijdkekdefwji");
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