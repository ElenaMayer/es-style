<?php

class TinyMCEPopup
{
    public static function registerClientScripts()
    {
        // Publishing assets.
        $dir = dirname(__FILE__);
        $assets = Yii::app()->getAssetManager()->publish($dir.DIRECTORY_SEPARATOR.'assets');

        // Registering javascript.
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($assets.'/tiny_mce_popup.js');
    }
}