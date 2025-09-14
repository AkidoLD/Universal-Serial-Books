<?php

    namespace App\View\Components;
    use App\View\Components\Component;
    /**
     * This class is used to represent a dialog box
     */
    class DialogBox extends Component{

        private string $title;

        public function __construct(string $blockName = 'dialog', string $title) {
            parent::__construct($blockName,['dialog']);
            $this->title = $title;
        }

        public function render(){
            $this->setStyle();
            ?>
            <div class="overlay" id="overlay" >
                <div class="<?=implode(' ', $this->classes)?> <?=implode(' ', $this->elements)?> <?=$this->blockName?>" id="<?=$this->id?>" >
                    <div class="dialog_header">
                        <?=$this->title?>
                    </div>
                    <div class="dialog_content">
                    <?php
                        $this->renderChilds();
                    ?>
                    </div>
                </div>
            </div>                
            <?php
        }

        public function renderChilds(){
            foreach($this->children as $child){
                $child->render();
            }
        }

        public function setStyle(){
            ?>
                <link rel="stylesheet" href="/Universal-Serial-Books/public/assets/css/DialogBox.css">
            <?php
        }
    }