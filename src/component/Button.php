<?php
    require_once __DIR__.'/../component/Component.php';
    class Button extends Component{
        private string $text;

        public function __construct() {
            parent::__construct('button', ['button']);
        }
        public function hide(){

        }
        public function render(){
            ?>
            <input type="button" class="<?=implode('',$this->getClasses())?>">
            <?php 
        }
        public function disable(){

        }
        public function enable(){
            
        }
        /**
         * Function used to make current button round
         * @param int $round
         * @return void
         */
        public function round(int $round){
            ?>
            <style>
                <?='.'.$this->blockName?>{
                    border-radius: <?=$round?>;
                }
            </style>
            <?php
        }
    }