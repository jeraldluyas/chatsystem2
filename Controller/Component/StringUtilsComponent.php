<?php
class StringUtilsComponent extends Component{
    public static function htmlentities($str){
        return htmlentities($str);
    }

    public static function formatTimeStamp($timestamp, $format = 'Y-m-d H:i:s'){
        $date = date_create();
        $date->setTimestamp($timestamp);
        return $date->format($format);
    }
}
