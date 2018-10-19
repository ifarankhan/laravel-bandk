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
        $html = $html . '<li class="home '.$category->title.'" ><a  class="load-content" href="javascript:;" data-id="'.$category->id.'" data-url="'.route("content.list", ["categoryId" => $category->id]).'">'. $category->title.' </a>';

        if($category->childrenCount > 0) {
            $html = $html . '<ul class="nav child_menu" style="display:none;" id="ul_'.$category->id.'">';
            getLeftMenu($category->children,$html);
            $html = $html . '</ul>';
        }
        $html = $html . '</li>';
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