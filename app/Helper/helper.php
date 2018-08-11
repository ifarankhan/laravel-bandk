<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/11/2018
 * Time: 10:22 AM
 */


/**
 * @param $key
 * @return array|null|string
 */
function getTranslation($key)
{
    $key = 'site.'.$key;
    return __($key);
}