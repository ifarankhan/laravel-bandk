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
}