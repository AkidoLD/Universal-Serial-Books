<?php

    namespace App\View\Components;
    use App\View\Components\Component;
    /**
     * This class is used to represent a dialog box
     */
    class DialogBox extends Component{

        private string $title;
        private $content;

        public function __construct(string $blockName = 'dialog', string $title) {
            parent::__construct($blockName, ['dialog']);
            $this->title = $title;
            $this->content = '';
        }

        /**
         * Function used to make dialog box visible and his children by user
         * @return void
         */
        public function render(){
            $this->setStyle();
            ?>
            <div class="overlay" id="overlay" >
                <div class="<?=implode(' ', $this->classes)?> <?=implode(' ', $this->elements)?> <?=$this->blockName?>" id="<?=$this->id?>" >
                    <div class="dialog_header">
                        <h2><?=$this->title?></h2>
                    </div>
                    <div class="dialog_content">
                        <?=$this->content?>
                    <?php
                        $this->renderChilds();
                    ?>
                    </div>
                </div>
            </div>                
            <?php
        }

        /**
         * Function used to set visible all the children of the current dialog box
         * @return void
         */
        private function renderChilds(){
            foreach($this->children as $child){
                $child->render();
            }
        }

        /**
         * Function used to link dialog box to his style stocked on css file
         * @return void
         */
        public function setStyle(){
            ?>
                <link rel="stylesheet" href="/Universal-Serial-Books/public/assets/css/DialogBox.css">
            <?php
        }

        public function setContent(string $newContent){
            $this->content = $newContent;
        }
    }