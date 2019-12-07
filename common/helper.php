<?php
/**
 * 判断字符是否存在二维数组
 * @param $value
 * @param $array
 * @return bool|int|string
 */
function deep_in_array($value, $array) {
    //
    foreach($array as $key=> $item) {

        if(!is_array($item)) {
            if ($item == $value) {
                return 1;
            } else {
                continue;
            }
        }

        if(in_array($value, $item)) {
            return $key;
        } else if(deep_in_array($value, $item)) {
            return $key;
        }
    }
    return false;
}