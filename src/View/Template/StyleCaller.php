<?php
    namespace App\View\Template;
    use App\Enums\StylesList;
    use App\View\Components\Component;
    class StyleCaller extends Component{
        private array $stylesCalled;
        public function __construct(){
            parent::__construct('style',['style']);
            $this->stylesCalled = [];
        }

        /**
         * This function set style visible by the navigator
         * @return void
         */
        public function render(){
            foreach($this->stylesCalled as $style){
                ?>
                <link rel="stylesheet" href="<?=$style?>">
                <?php
            }
        }

        /**
         * This function is used to target a specific style or styles
         * @param array $styles
         * @return void
         */
        public function callSpecificStyle(array $styles){
            $this->stylesCalled = $styles;
        }

        /**
         * This function set all the styles on the page
         * @return void
         */
        public function callAllStyles(){
            $this->stylesCalled = StylesList::returnStyles();
        }
    }
?>