<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\ContentRequest;
use App\Http\Requests\CustomerContentRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\CategoryInterface;
use App\Repositories\ContentInterface;
use App\Repositories\ContentRepository;
use App\Repositories\CustomerInterface;
use App\Repositories\DepartmentsInterface;
use App\Repositories\ModulesInterface;
use App\Repositories\RolesInterface;
use App\Repositories\UserInterface;
use Illuminate\Http\Request;

class ContentsController extends Controller
{


    /**
     * @var ContentInterface
     */
    private $content;
    /**
     * @var CategoryInterface
     */
    private $category;
    /**
     * @var CustomerInterface
     */
    private $customer;

    /**
     * ContentsController constructor.
     * @param ContentInterface $content
     * @param CategoryInterface $category
     * @param CustomerInterface $customer
     */
    public function __construct(ContentInterface $content, CategoryInterface $category, CustomerInterface $customer)
    {
        $this->content = $content;
        $this->category = $category;
        $this->customer = $customer;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $contents = $this->content->search($search);
        $customers = $this->customer->all();
        return view('contents.index', compact('contents', 'customers', 'search'));
    }

    public function create()
    {
        $parents = $this->category->all();
        return view('contents.create', compact('parents'));
    }
    public function edit($id)
    {
        $content = $this->content->getOne($id);
        $parents = $this->category->all();
        return view('contents.edit', compact('content', 'parents'));
    }
    public function customerCategoryContent($categoryId, $customerId)
    {
        $contents = $this->content->getContentByCustomerIDAndCategoryId($categoryId, $customerId);
        $customer = $this->customer->getOne($customerId);
        return view('contents.create_edit_customers', compact('contents', 'categoryId', 'customer'));
    }

    public function postCustomerCategoryContent($categoryId, $customerId, CustomerContentRequest $request)
    {
        $data = $request->all();
        $response = $this->content->saveCustomerCategoryContent($data);
        if($response) {
            $request->session()->flash('alert-success', getTranslation('content_create_success_message'));
            return redirect()->route('category.customer.content', ['category_id' => $categoryId, 'id' => $customerId]);
        } else {
            $request->session()->flash('alert-danger', getTranslation('content_create_error_message'));
            return redirect()->route('category.customer.content', ['category_id' => $categoryId, 'id' => $customerId]);
        }
    }

    public function store(ContentRequest $request)
    {
        $data = $request->all();
        $response = $this->content->store($data);

        if($response) {
            $request->session()->flash('alert-success', getTranslation('content_create_success_message'));
            return redirect()->route('content.index');
        } else {
            $request->session()->flash('alert-danger', getTranslation('content_create_error_message'));
            return redirect()->route('content.index');
        }
    }

    public function delete($id)
    {
        $response = $this->content->delete($id);

        if($response) {
            return [
                'status' => '200',
                'success' => true
            ];
        }
        return [
            'status' => '200',
            'success' => false
        ];

    }

    public function getList($categoryId)
    {
        $contents = $this->content->getByCategoryIdAndCustomerId($categoryId, \Auth::user()->customer_id);
        $category = $this->category->getOne($categoryId);

        $html = view('partials.category-detail', compact('contents', 'category'))->render();

        return [
            'html' => $html,
            'status' => true,
            'icon' => true,
        ];
    }
}