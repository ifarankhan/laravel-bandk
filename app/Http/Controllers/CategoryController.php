<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    /**
     * @var CategoryInterface
     */
    private $category;

    /**
     * CategoryController constructor.
     * @param CategoryInterface $category
     */
    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = $this->category->all();
        return view('categories.create', compact('parents'));
    }
    public function edit($id)
    {
        $content = $this->category->getOne($id);
        $parents = $this->category->all();
        return view('categories.edit', compact('content', 'parents'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $response = $this->category->store($data);

        if($response) {
            $request->session()->flash('alert-success', getTranslation('category_create_success_message'));
            return redirect()->route('category.index');
        } else {
            $request->session()->flash('alert-danger', getTranslation('category_create_error_message'));
            return redirect()->route('category.index');
        }
    }

    public function delete($id)
    {
        $response = $this->category->delete($id);

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

    public function allCategories(Request $request)
    {
        $get = $request->query();
        return  $this->category->allCategories($get);
    }

    public function categoryUpdate(Request $request)
    {
        $get = $request->query();
        $response = $this->category->updateCategory($get);

        return [
            'response' => $response
        ];
    }
    public function categoryCreate(Request $request)
    {
        $get = $request->query();
        return  $this->category->categoryCreate($get);
    }
    public function categoryRemove(Request $request)
    {
        $get = $request->query();
        return [
            'response' => $this->category->categoryRemove($get)
        ];
    }
}