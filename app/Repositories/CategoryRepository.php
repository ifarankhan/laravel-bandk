<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 9:36 PM
 */

namespace App\Repositories;


use App\Category;

class CategoryRepository implements CategoryInterface
{
    private $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function all()
    {
        $query = $this->model;

        if(\Auth::check() && !is_null(\Auth::user()->customer_id) && !in_array('ADMIN', getUserRoles(\AUth::user()))) {
           $query = $query->orwhere('customer_id', null);
           $query = $query->orwhere('customer_id', \Auth::user()->customer_id);
        }
        return $query->with(['parent'])->get();
    }

    public function getOne($id)
    {
        return $this->model->find($id);
    }
    public function getFirst()
    {
        return $this->model->first();
    }

    public function store($data)
    {
        if(isset($data['id'])) {
            $this->model = $this->model->find($data['id']);
        }

        $this->model->title = $data['title'];
        $this->model->parent_id = isset($data['parent_id']) ? $data['parent_id'] : null;
        $this->model->color = isset($data['color']) ? $data['color'] : null;
        $this->model->customer_id = isset($data['customer_id']) ? $data['customer_id'] : null;

        if(isset($data['show_on_frontend'])) {
            $this->model->show_on_frontend = true;
        } else  {
            $this->model->show_on_frontend = false;
        }

        if(isset($data['icon'])) {
            $uniqueFileName = uniqid() . $data['icon']->getClientOriginalName();//.'.'.$image->getClientOriginalExtension();
            $data['icon']->move(config('app.path_to_upload').'/icons/' , $uniqueFileName);

            $this->model->icon = $uniqueFileName;
        }

        $this->model->save();

        return $this->model;

    }

    public function delete($id)
    {
        return $this->getOne($id)->delete();
    }

    public function getCategories($parentId)
    {
        if($parentId == -1) {
            $parentId = null;
        }
        $query = $this->model;
        if(is_null($parentId)) {
            $query = $query->where('parent_id', $parentId);
        } else {
            $query = $query->where('id', $parentId);
        }
        $isLogin = \Auth::check();
        $user = \Auth::user();

        $query = $query->where(function ($q) use($isLogin, $user){
            $q = $q->orwhere('customer_id',null);
            if($isLogin && !is_null($user->customer_id) && !in_array('ADMIN', getUserRoles($user))) {
                $q = $q->orwhere('customer_id',$user->customer_id);
            }

            return $q;
        });

        return $query->get();



    }

    public function getCategory($categoryId)
    {
        return  $this->model->with(['contents'])->where('id', $categoryId)->first(['id', 'title', 'icon', 'color', 'show_on_frontend']);
    }

    public function allCategories($get)
    {
        $node = isset($get['id']) && $get['id'] !== '#' ? (int)$get['id'] : 0;
        $categories = $this->all();
        $data = [];
        if(count($categories) <=0){
            //add condition when result is zero
        } else {

            $itemsByReference = array();

            $data = $categories->toArray();

            // Build array of item references:
            foreach($data as $key => &$item) {
                $itemsByReference[$item['id']] = &$item;
                // Children array:
                $itemsByReference[$item['id']]['children'] = array();
                // Empty data class (so that json_encode adds "data: {}" )
                $itemsByReference[$item['id']]['data'] = new \StdClass();
            }

            // Set items as children of the relevant parent item.
            foreach($data as $key => &$item)
                if($item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
                    $itemsByReference [$item['parent_id']]['children'][] = &$item;

            // Remove items that were added to parents elsewhere:
            foreach($data as $key => &$item) {
                if($item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
                    unset($data[$key]);
            }
        }
        return $data;
    }

    public function updateCategory($data)
    {
        $node = isset($data['id']) && $data['id'] !== '#' ? (int)$data['id'] : 0;

        $category = $this->getOne($node);

        if($category) {
            $category->title = $data['text'];
            return $category->save();
        }

        return true;
    }
    public function categoryCreate($data)
    {
        $node = isset($data['id']) && $data['id'] !== '#' ? (int)$data['id'] : 0;

        $this->model->parent_id = $node;
        $this->model->title = isset($data['text']) ? $data['text'] : '';

        $this->model->save();

        return $this->model;
    }

    public function categoryRemove($data)
    {
        $category = $this->getOne($data['id']);

        if($category) {
            $category->delete();
            \DB::table('categories')->where('parent_id', $data['id'])->delete();
        }

        return true;
    }
}