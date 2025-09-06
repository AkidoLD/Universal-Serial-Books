<?php
    require_once __DIR__.'../component/Component.php';
    class Button extends Component{
        public function __construct() {
            parent::__construct('button');
        }
        public function hide(){

        }
        public function render(){
            ?>
            <input type="button">
            <?php 
        }
        public function disable(){

        }
        public function enable(){
            
        }
    }