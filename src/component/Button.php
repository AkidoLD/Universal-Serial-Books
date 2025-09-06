<?php
    require_once __DIR__.'/../component/Component.php';
    class Button extends Component{
        private string $text;

        /**
         * Constructor of a button component
         * @param string $textContent
         */
        public function __construct(string $textContent) {
            parent::__construct('button', ['button']);
            $this->text = $textContent;
        }

        /**
         * Function used to hide a button
         * @return void
         */
        public function hide(){

        }
        /**
         * Function used to render a button
         * @return void
         */
        public function render(){
            ?>
            <input type="button" class="<?=implode('',$this->getClasses())?>" value="<?=$this->text?>">
            <?php 
        }

        /**
         * Function used to make a button no workable
         * @return void
         */
        public function disable(){

        }

        /**
         * A function to make a button workable
         * @return void
         */
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
                    border-radius: <?=$round?>px;
                }
            </style>
            <?php
        }

        /**
         * This function is used to set the color of the background of the current button
         * @param string $color
         * @return void
         */
        public function setBColor(string $color){
            ?>
            <style>
            <?='.'.$this->blockName?>{
                background : <?=$color?>;
            }
            </style>
            <?php
        }
    }