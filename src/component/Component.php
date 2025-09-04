<?php
    abstract class Component{
        /**
         * Class reserved to basic component visible on the website
         */

        protected string $id;
        protected array $classes;
        protected array $attributes;
        protected string $blockName;  
        public function __construct(array $class = ['component'], array $attributes = [], string $blockName) {
            $this->classes = $class;
            $this->attributes = $attributes;
            $this->blockName = $blockName;
        }
        
        /**
         * function used to set the id of current component
         * @param string $newId
         * @return void
         */
        public function setId(string $newId){
            $this->id = $newId;
        }

        /**
         * Function used to set the classes of current component 
         * @param array $newClass array of new classes to set
         * @return void
         */
        public function setClasses(array $newClass){
            $this->classes = $newClass;
        }
        
        /**
         * Function used to add classes to current component
         * @param array $addedClasses
         * @return void
         */
        public function addClasses(array $addedClasses){
            array_push($this->classes, $addedClasses);
        }
        /**
         * Function used to set attributes of current component
         * @param array $newAttributes array of attributes to set
         * @return void
         */
        public function setAttributes(array $newAttributes){
            $this->attributes = $newAttributes;
        }

        public function addAttributes(array $addedAttributes){
            array_push($this->attributes, $addedAttributes);
        }

        public function setBlockName(string $newBlockName){
            $this->blockName = $newBlockName;
        }

    }