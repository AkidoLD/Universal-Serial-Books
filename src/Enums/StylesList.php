<?php
    /**
     * An enumaration used to add specific or all the styles files.
     */
    namespace App\Enums;
    enum StylesList : string {
        case BUTTON = "/Universal-Serial-Books/public/assets/css/Button.css";
        case DIALOG_BOX = "/Universal-Serial-Books/public/assets/css/DialogBox.css";
        case FIRST_COVER = "/Universal-Serial-Books/public/assets/css/FirstCover.css";
        case ICONIC_BUTTON = "/Universal-Serial-Books/public/assets/css/IconicButton.css";
        public static function returnStyles(){
            return array_column(self::cases(),'value');
        }
    }