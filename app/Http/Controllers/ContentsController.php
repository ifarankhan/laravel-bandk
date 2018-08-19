<?php
/**
 * Created by PhpStorm.
 * User: fara
 * Date: 8/3/2018
 * Time: 10:02 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\ContentRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\CategoryInterface;
use App\Repositories\ContentInterface;
use App\Repositories\ContentRepository;
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
     * ContentsController constructor.
     * @param ContentInterface $content
     * @param CategoryInterface $category
     */
    public function __construct(ContentInterface $content, CategoryInterface $category)
    {
        $this->content = $content;
        $this->category = $category;
    }

    public function index()
    {
        $contents = $this->content->all();
        return view('contents.index', compact('contents'));
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

    public function store(ContentRequest $request)
    {
        $data = $request->all();
        $response = $this->content->store($data);

        if($response) {
            $request->session()->flash('alert-success', 'Content has been created/updated successfully.');
            return redirect()->route('content.index');
        } else {
            $request->session()->flash('alert-danger', 'Error while updating/creating content.');
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
        $contents = $this->content->getByCategoryId($categoryId);
        $category = $this->category->getOne($categoryId);

        $html = view('partials.category-detail', compact('contents', 'category'))->render();

        return [
            'html' => $html,
            'status' => true
        ];
    }
}