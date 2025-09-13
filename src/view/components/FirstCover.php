<?php
use App\View\Components\Component;

    /**
     * This class is used to set first cover (first view of book visible by the user)
     */
    class FirstCover extends Component{

        public function __construct(string $blockName = 'firstCover') {
            parent::__construct($blockName, ['firstCover']);
        }

        public function render(){
            $this->setStyle();
            ?>
            <div>
                <?php
                    $this->renderChilds();
                ?>
            </div>
            <?php
        }

        private function setStyle(){
            ?>
            <link rel="stylesheet" href="/Universal-Serial-Books/src/View/css/FirstCover.css">
            <?php
        }

        private function renderChilds(){
            foreach ($this->children as $key => $value){
                $value->render();
            }
        }
    }