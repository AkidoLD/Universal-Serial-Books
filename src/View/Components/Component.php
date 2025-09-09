<?php
    abstract class Component{
        /**
         * Class reserved to basic component visible on the website
         */

        protected string $name;
        protected string $id;
        protected array $classes;
        protected string $blockName;  
        protected array $elements;
        protected array $modifiers;
        protected bool $visible;
        protected bool $workable;
        protected array $childs;
        protected Component $parent;

        public function __construct(string $blockName, array $class = ['component']) {
            $this->classes = $class;
            $this->blockName = $blockName;
            $this->elements = [];
            $this->modifiers = [];
            $this->workable = true;
            $this->visible = true;
            $this->name = $blockName;
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
         * Function used to add a block to the BEM of current component
         * @param string $newBlockName
         * @return void
         */
        public function setBlockName(string $newBlockName){
            $this->blockName = $newBlockName;
        }

        /**
         * Function used to add modifier to block on BEM. It returns a boolean depends of
         * the presence of element in array of elements and presence of the modifier to set in
         * the modifier array
         * @param string $modifierName
         * @param string $elementLinked
         * @return bool
         */
        public function addModifier(string $modifierName, string $elementLinked) {
            if(in_array($elementLinked, $this->elements) and !in_array($elementLinked.'--'.$modifierName, $this->modifiers)){
                array_push($this->modifiers, $elementLinked.'--'.$modifierName);
                return true;
            } else {
                return false;
            }
        }

        /**
         * Function used to add element to block on BEM. It returns a boolean depends of
         * the presence of element in array of elements
         * @param string $elementName
         * @return bool
         */
        public function addElement(string $elementName) : bool{
            if(!in_array($elementName, $this->elements)){
                array_push($this->elements, $this->blockName.'__'.$elementName);
                return true;
            } else {
                return false;
            }
        }

        /**
         * Function used to add a parent to the current component
         * @param Component $parent
         * @return void
         */
        public function setParent(?Component $parent){
            $this->parent = $parent;
        }

        /**
         * Function used to get the parent of the current component
         * @return Component
         */
        public function getParent(): Component{
            return $this->parent;
        }

        /**
         * Function used to set some child to the current component
         * @param array $childs
         * @return void
         */
        public function setChilds(array $childs){
            $this->childs = $childs;
        }

        /**
         * Function used to add child to the current component
         * @param Component $child
         * @return void
         */
        public function addChild(Component $child){
            array_push( $this->childs, $child);
        }

        /**
         * Function used to get all the childs of the current component
         * @return array
         */
        public function getChild(): array{
            return $this->childs;
        }

        public function setName(string $newName){
            $this->name = $newName;
        }

        public function getName(): string{
            return $this->name;
        }
        /**
         * Function used to make visible the current component
         * @return void
         */
        abstract public function render();

        /**
         * Function used to make the current component not workable
         * @return void
         */
        abstract public function disable();

        /**
         * Function used to make the current component workable
         * @return void
         */
        abstract public function enable();

        // /**
        //  * Function used to hide the current component
        //  * @return void
        //  */
        abstract public function hide();
    }