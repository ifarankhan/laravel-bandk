<?php

namespace App\Http\Controllers;

use App\Repositories\ContentInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var ContentInterface
     */
    private $content;

    /**
     * Create a new controller instance.
     *
     * @param ContentInterface $content
     */
    public function __construct(ContentInterface $content)
    {
        $this->middleware('auth');
        $this->content = $content;

        \View::share('categories', $this->content->getCategories(null));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = $this->content->getFirst();
        return view('site.index', compact('category'));
    }

    public function categoryDetail($slug)
    {
        $slug = explode('-', $slug);
        $id = $slug[count($slug) - 1];
        $category = $this->content->getOne($id);
        return view('site.index', compact('category'));

    }
}
