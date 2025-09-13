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
            <input type="button" 
                class="
                    <?=$this->blockName?>
                    <?=implode('', $this->classes)?>
                    <?=implode('',$this->getClasses())?>
                    <?=implode('', $this->elements)?>
                    <?=implode('', $this->modifiers)?>
                " 
                id="<?=$this->id?>"
                name="<?=$this->name?>"
                value="<?=$this->text?>"
            >
            <?php
                $this->setStyle();
        }

        /**
         * This function is used to set the primary styleof buttons to the current button
         * @return void
         */
        private function setStyle(){
            ?>
            <link rel="stylesheet" href="/Universal-Serial-Books/src/View/css/Button.css">
            <?php
        }
    }