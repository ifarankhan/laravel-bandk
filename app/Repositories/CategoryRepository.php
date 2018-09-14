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
        return $this->model->with(['parent'])->get();
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

        $this->model->save();

        return $this->model;

    }

    public function delete($id)
    {
        return $this->getOne($id)->delete();
    }

    public function getCategories($parentId)
    {
        if(is_null($parentId)) {
            return  $this->model->where('parent_id', $parentId)->get(['id', 'title']);
        } else {
            return  $this->model->where('id', $parentId)->get(['id', 'title']);
        }

    }

    public function getCategory($categoryId)
    {
        return  $this->model->with(['contents'])->where('id', $categoryId)->first(['id', 'title']);
    }

    public function allCategories($get)
    {
        $node = isset($get['id']) && $get['id'] !== '#' ? (int)$get['id'] : 0;
        $categories = $this->model->orderBy('parent_id', 'ASC')->get(['id', 'title as text', 'parent_id']);
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