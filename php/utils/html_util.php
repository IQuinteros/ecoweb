<?php

class HtmlUtil {

    public static function convertToHtmlSpecialObject($object) {

        $array = (array)$object;

        foreach($array as &$element){
            if(is_string($element)){
                $element = htmlspecialchars($element);
            }
            if(is_array($element)){
                $insideObj = json_decode(json_encode($element));
                $element = json_decode(json_encode(HtmlUtil::convertToHtmlSpecialObject($insideObj)), true);
            }
        }

        return (object)$array;
        
    }

}