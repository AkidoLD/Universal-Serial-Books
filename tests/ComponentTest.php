<?php
    require_once __DIR__.'/../src/view/component/Component.php';
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
        public function show(){
            ?>
            <style>
                <?='.'.$this->blockName?>{
                    display : inline;
                }
            </style>
            <?php
        }
        public function hide(){
            ?>
            <style>
                <?='.'.$this->blockName?>{
                    display : none;
                }
            </style>
            <?php
        }
        public function enable(){
            ?>
            <style>
                <?='.'.$this->blockName?>{
                    color : black;
                }
            </style>
            <?php
        }
        public function disable(){
            ?>
            <style>
                <?='.'.$this->blockName?>{
                    color: gray;
                }
            </style>
            <?php
        }
    }
    $comp = new ComponentTest;
    $comp->disable();
    $comp->render();
    