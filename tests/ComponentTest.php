<?php
    require_once __DIR__.'/../src/component/Component.php';
    class ComponentTest extends Component{
        public function __construct() {
            parent::__construct('testBlock');
        }
        public function render(){
            ?>
            <div class=<?=$this->blockName?>>
                <?=$this->blockName?>
            </div>  
            <?php
        }
        public function hide(){
            if ($this->visible){
                ?>
                <style>
                    <?='.'.$this->blockName?>{
                        display : none;
                    }
                </style>
                <?php
            } else {
                return;
            }
        }
    }
    $comp = new ComponentTest;
    $comp->render();
    $comp->hide();