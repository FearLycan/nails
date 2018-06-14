<?php

namespace app\components;

/**
 * General app helper.
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class Helpers
{
    public static function nameize($str, $a_char = ["'", "-", " "])
    {
        //$str contains the complete raw name string
        //$a_char is an array containing the characters we use as separators for capitalization. If you don't pass anything, there are three in there as default.
        $string = mb_strtolower($str, 'UTF-8');
        foreach ($a_char as $temp) {
            $pos = strpos($string, $temp);
            if ($pos) {
                //we are in the loop because we found one of the special characters in the array, so lets split it up into chunks and capitalize each one.
                $mend = '';
                $a_split = explode($temp, $string);
                foreach ($a_split as $temp2) {
                    //capitalize each portion of the string which was separated at a special character
                    $mend .= self::ucfirstUtf8($temp2) . $temp;
                }
                $string = substr($mend, 0, -1);
            }
        }
        return ucfirst($string);
    }

    public static function ucfirstUtf8($str)
    {
        if (mb_check_encoding($str, 'UTF-8')) {
            $first = mb_substr(mb_strtoupper($str, 'UTF-8'), 0, 1, 'UTF-8');
            return $first . mb_substr(mb_strtolower($str, 'UTF-8'), 1, mb_strlen($str), 'UTF-8');
        } else {
            return $str;
        }
    }
}