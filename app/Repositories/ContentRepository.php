<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/1/2018
 * Time: 9:36 PM
 */

namespace App\Repositories;


use App\Content;

class ContentRepository implements ContentInterface
{
    /**
     * @var Content
     */
    private $model;

    /**
     * ContentRepository constructor.
     * @param Content $content
     */
    public function __construct(Content $content)
    {
        $this->model = $content;
    }

    public function all()
    {
        return $this->model->with(['category'])->get();
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
        $this->model->description = $data['description'];
        $this->model->category_id = isset($data['category_id']) ? $data['category_id'] : null;

        $this->model->save();

        return $this->model;

    }

    public function delete($id)
    {
        return $this->getOne($id)->delete();
    }

    public function getByCategoryId($categoryId)
    {
        return $this->model->where('category_id', $categoryId)->get();
    }
}