<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/11/2018
 * Time: 10:22 AM
 */

function get_mb($size) {
    return round($size/1048576,2);
}
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
        if($category->show_on_frontend == true) {

            if (!is_null($category->icon)) {
                $html = $html . '<li class="home ' . $category->title . '" >
        <a  class="load-content" href="javascript:;" data-id="' . $category->id . '" data-url="' . route("content.list", ["categoryId" => $category->id]) . '">
        <image style="height:30px;" src="' . $category->icon . '" />&nbsp;&nbsp;&nbsp;'
                    . $category->title . ' </a>';

            } else {
                $html = $html . '<li class="home ' . $category->title . '" >
        <a  class="load-content" href="javascript:;" data-id="' . $category->id . '" data-url="' . route("content.list", ["categoryId" => $category->id]) . '">' . $category->title . ' </a>';

            }

            if ($category->childrenCount > 0) {
                $html = $html . '<ul class="nav child_menu" style="display:none;" id="ul_' . $category->id . '">';
                getLeftMenu($category->children, $html);
                $html = $html . '</ul>';
            }
            $html = $html . '</li>';
        }
    }

    return $html;
}

function getClaimColor($claim)
{
    $color = '';
    if($claim->status == 'FOR_BNK' || $claim->status == 'FOR_MANAGER' || $claim->status == 'OPEN') {
        $color = 'danger';
    } elseif ($claim->status == 'CLOSED') {
        $color = 'success';
    }
    return $color;
}
function getClaimStatus($claim)
{
    $status = '';
    if($claim->status == 'FOR_BNK' || $claim->status == 'FOR_MANAGER') {
        $status = getTranslation('not_processed');
    } elseif ($claim->status == 'OPEN') {
        $status = getTranslation('open');
    } elseif ($claim->status == 'CLOSED') {
        $status = getTranslation('closed');
    }
    return $status;
}

function getUserRoles($user)
{
    return  ($user->roles) ? $user->roles->pluck('name')->toArray() : [];
}

function dateFormat($date, $format = 'd/m/Y') {
    $date = strtotime($date);
    $date = date($format, $date);
    return $date;
}

function isUpdated($claim)
{
    $isUpdated = $claim->is_updated;

    if($isUpdated) {
        $claim->is_updated = false;
        $claim->save();
    }

    return $isUpdated;
}

function needRotate($filename)
{
    list($width, $height) = getimagesize($filename);
    if($height < $width) {
        return true;
    }
    return false;
}

