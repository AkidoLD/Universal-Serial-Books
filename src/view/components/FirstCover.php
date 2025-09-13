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
            ?>
            <div>
                
            </div>
            <?php
        }

        public function setStyle(){

        }

        public function renderChilds(){

        }
    }