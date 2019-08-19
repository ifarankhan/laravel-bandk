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

function getCategoryIdAndName($contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $content) {
            if(isset($content->category)) {
                return [
                    'id' => $content->category->id,
                    'title' => $content->category->title
                ];
            }
        }
    }
    return [];
}

function getCustomerName($contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $content) {
            if(isset($content->customer)) {
                return [
                    'name' => $content->customer->name,

                ];
            }
        }
    }
    return [];
}



function hasDefaultContent($contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $content) {
            if(is_null($content->customer_id)) {
                return true;
            }
        }
    }
    return false;
}
function hasUserSpecificContent($contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $content) {
            if(!is_null($content->customer_id)) {
                return true;
            }
        }
    }
    return false;
}

function hasThisUserSpecificContent($user, $contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $content) {
            if(!is_null($user->customer) && !is_null($content->cutomer_id) && $user->customer->id == $content->cutomer_id) {
                return $content;
            }
        }
    }
    return false;
}
function hasThisUserSpecificContentByCompanyByCustomerThenDefault($user, $contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $content) {
            if(!is_null($user->customer) && !is_null($content->cutomer_id) && $user->customer->id == $content->cutomer_id) {
                return $content;
            }
        }
    }
    return false;
}



function getDefaultTitle($contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $content) {
            if(is_null($content->customer_id)) {
                return $content->title;
            }
        }
    }
    return false;
}
function getUserSpecificTitle($contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $content) {
            if(!is_null($content->customer_id)) {
                return $content->title;
            }
        }
    }
    return false;
}

function getDefaultContent($contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $content) {
            if(is_null($content->customer_id)) {
                return $content->description;
            }
        }
    }
    return false;
}

function getDefaultContents($contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $key => $content) {
            if(!is_null($content->customer_id)) {
                unset($contents[$key]);
            }
        }

        return $contents;
    }
    return false;
}

function getDefaultContentId($contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $content) {
            if(is_null($content->customer_id)) {
                return $content->id;
            }
        }
    }
    return false;
}



function getUserSpecificContent($contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $content) {
            if(!is_null($content->customer_id)) {
                return $content->description;
            }
        }
    }
    return false;
}

function getUserSpecificContentId($contents)
{
    if(!is_null($contents)) {
        foreach ($contents as $content) {
            if(!is_null($content->customer_id)) {
                return $content->id;
            }
        }
    }
    return false;
}

function getCompanyContent($companyId, $customerId, $categoryId)
{
    $content = app(\App\Repositories\ContentInterface::class)->getCompanyContent($companyId, $customerId, $categoryId);
    $contentArray = [];
    if(!isset($content->id)) {
        $contentArray['id'] = '';
    } else {
        $contentArray['id'] = $content->id;
    }
    if(!isset($content->title)) {
        $contentArray['title'] = '';
    } else {
        $contentArray['title'] = $content->title;
    }
    if(!isset($content->description)) {
        $contentArray['description'] = '';
    } else {
        $contentArray['description'] = $content->description;
    }

    return $contentArray;


}
