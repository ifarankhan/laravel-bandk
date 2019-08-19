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
    public function search($search)
    {
        $query = $this->model;
        if($search && isset($search['customer_id'])) {
            $query = $query->orwhere('customer_id', null);
            $query = $query->orwhere('customer_id', $search['customer_id']);
        }
        return $query->with(['category'])->get();
    }
    public function getContentByCustomerIDAndCategoryId($categoryId, $customerId)
    {
        $query = $this->model;
        $query = $query->where('category_id', $categoryId);
        $query = $query->where('customer_id', null);
        $query = $query->orwhere('category_id', $categoryId);
        $query = $query->where('customer_id', $customerId);
        return $query->with(['category', 'customer'])->get();
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
        if(isset($data['customer_id'])) {
            $this->model->customer_id = $data['customer_id'];
        }

        $this->model->title = $data['title'];
        $this->model->description = $data['description'];
        $this->model->category_id = isset($data['category_id']) ? $data['category_id'] : null;

        $this->model->save();

        return $this->model;

    }

    public function saveCustomerCategoryContent($data)
    {

        if(isset($data['default_content_id'])) {
            $defaultContent = $this->model->find($data['default_content_id']);
        } else {
            $defaultContent = new Content();
        }

        $defaultContent->title = $data['default_title'];
        $defaultContent->description = $data['default_description'];
        $defaultContent->category_id = isset($data['category_id']) ? $data['category_id'] : null;
        $defaultContent->save();

        if(isset($data['customer_content_id'])) {
            $this->model = $this->model->find($data['customer_content_id']);
        }

        $this->model->title = $data['title'];
        $this->model->description = $data['description'];
        $this->model->customer_id = isset($data['customer_id']) ? $data['customer_id'] : null;
        $this->model->category_id = isset($data['category_id']) ? $data['category_id'] : null;

        $this->model->save();

        $result = $this->model;

        if(isset($data['company_title_description'])) {
            foreach ($data['company_title_description'] as $companyId => $content) {
                if(!is_null($content['content_id'])) {
                    $this->model = $this->model->find($content['content_id']);
                } else {
                    $this->model = new Content();
                }
                if(!is_null($content['title']) && !is_null($content['description'])) {
                    $this->model->title = ($content['title']) ? $content['title'] : '';
                    $this->model->description = ($content['description']) ? $content['description'] : '';
                    $this->model->company_id = $companyId;
                    $this->model->customer_id = isset($data['customer_id']) ? $data['customer_id'] : null;
                    $this->model->category_id = isset($data['category_id']) ? $data['category_id'] : null;

                    $this->model->save();
                }

            }
        }

        return $result;

    }


    public function getSpecificContent($categoryId, $companyId, $customerId)
    {
        $result = [];
        $userCompanies = \Auth::user()->companies;
        if($userCompanies) {
            $companiesList = $userCompanies->pluck('company_id')->toArray();

            if(in_array($companyId, $companiesList)) {
                $content = $this->getCompanyContent($companyId, $customerId, $categoryId);

                if($content) {
                    $result[] = $content;
                } else {
                    $content = $this->getByCategoryIdAndCustomerId($categoryId, $customerId);

                    if($content) {
                        $result[] = $content;
                    }
                }
            } else {
                $content = $this->getByCategoryIdAndCustomerIdForCompany($categoryId, $customerId);

                if($content) {
                    $result[] = $content;
                }
            }
        }else {
            $content = $this->getByCategoryIdAndCustomerIdForCompany($categoryId, $customerId);

            if($content) {
                $result[] = $content;
            }
        }

        return $result;
    }
    public function delete($id)
    {
        return $this->getOne($id)->delete();
    }

    public function getByCategoryId($categoryId)
    {
        return $this->model->where('category_id', $categoryId)->get();
    }

    public function getByCategoryIdAndCustomerId($categoryId, $customerId)
    {
        $content =  $this->model->where('category_id', $categoryId)->where('customer_id', $customerId)->get();

        if(is_null($content)) {
            $content =  $this->model->where('category_id', $categoryId)->where('customer_id', null)->get();
        }

        return $content;
    }
    public function getByCategoryIdAndCustomerIdForCompany($categoryId, $customerId)
    {
        $content =  $this->model->where('category_id', $categoryId)->where('customer_id', $customerId)->where('company_id', null)->first();

        if(is_null($content)) {
            $content =  $this->model->where('category_id', $categoryId)->where('customer_id', null)->where('company_id', null)->first();
        }

        return $content;
    }

    public function getCompanyContent($companyId, $customerId, $categoryId)
    {
        return $this->model->where('company_id', $companyId)->where('customer_id', $customerId)->where('category_id', $categoryId)->first();
    }
}