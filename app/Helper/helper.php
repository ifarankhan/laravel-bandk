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

function getLeftMenu($categories,  &$html)
{
    foreach ($categories as $category) {
        $html = $html . '<li class="home_'.$category->title.'"><a href="javascript:;" data-url="'.route("home.category", ["slug" => str_slug($category->title).'-'.$category->id]).'">'. $category->title.' </a>';

        if($category->childrenCount > 0) {
            $html = $html . '<ul class="nav child_menu">';
            getLeftMenu($category->children,$html);
            $html = $html . '</ul>';
        }
        $html = $html . '</li>';
    }

    return $html;


}