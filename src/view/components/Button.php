<?php
    namespace App\View\Components;
    use App\View\Components\Component;
    /**
     * Class used to represent a button
     */
    class Button extends Component{
        private string $text;
        private array $style;

        /**
         * Constructor of a button component
         * @param string $textContent
         */
        public function __construct(string $textContent, string  $blockName = 'button') {
            parent::__construct($blockName, ['button']);
            $this->text = $textContent;
            $this->style = [];
        }

        /**
         * Function used to hide a button
         * @return void
         */
        public function hide(){
            ?>
            <style>
                <?='.'.$this->blockName?>{
                    display: none;
                }
            </style>
            <?php
        }
        /**
         * Function used to render a button
         * @return void
         */
        public function render(){
            ?>
            <input type="button" class="<?=implode('',$this->getClasses())?>" value="<?=$this->text?>" id="<?=$this->id?>" >
            <?php
        }

        /**
         * Function used to make a button no workable
         * @return void
         */
        public function disable(){
            ?>
            <style>
            <?='.'.$this->blockName?>{
                background : gray;
            }
            </style>
            <?php            

        }

        /**
         * A function to make a button workable
         * @return void
         */
        public function enable(){
            echo implode('',$this->style);
        }
        /**
         * Function used to make current button round
         * @param int $round
         * @return void
         */
        public function round(int $round){
            ob_start();
            ?>
            <style>
                <?='.'.$this->blockName?>{
                    border-radius: <?=$round?>px;
                }
            </style>
            <?php
            if(!in_array(ob_get_contents(), $this->style)){
                array_push($this->style, ob_get_contents());
            }
        }
    }