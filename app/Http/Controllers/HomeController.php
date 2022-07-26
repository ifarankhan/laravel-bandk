<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryInterface;

class HomeController extends Controller
{

    /**
     * @var CategoryInterface
     */
    private $category;

    /**
     * HomeController constructor.
     * @param CategoryInterface $category
     */
    public function __construct(CategoryInterface $category)
    {
        $this->middleware('auth');
        $this->category = $category;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \View::share('categories', $this->category->getCategories(null));
        $category = $this->category->getFirst();
        return view('site.index', compact('category'));
    }

    public function categoryDetail($slug)
    {
        \View::share('categories', $this->category->getCategories(null));
        $slug = explode('-', $slug);
        $id = $slug[count($slug) - 1];
        $category = $this->content->getOne($id);
        return view('site.index', compact('category'));

    }
}
