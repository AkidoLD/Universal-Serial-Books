<?php
    namespace App\View\Components;
    use App\View\Components\Component;
    class IconicButton extends Component{
        
        protected string $src;
        protected string $alt;
        protected $label;
        public function __construct( string $src, string $label, string $blockName="iconicButton") {
            parent::__construct($blockName);
            $this->src = $src;
            $this->alt = "icon of button";
            $this->label = $label;
        }

        /**
         * Function used to render a button and his icon
         * @return void
         */
        public function render(){
            ?>
                <div class="<?=implode(' ', $this->classes)?> <?=implode(' ', $this->elements)?> <?=$this->blockName?>" id="<?=$this->id?>">
                    <img src="<?=$this->src?>" alt="<?=$this->alt?>" ></img>
                    <h4><?=$this->label?></h4>
                </div>
            <?php
        }
    }