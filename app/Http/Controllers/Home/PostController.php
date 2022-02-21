<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\PostRepositoryInterface;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * @var $postRepo
     */
    private $postRepo;

    /**
     * @param PostRepositoryInterface $postRepo
     */
    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('home.posts.create');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $client = Auth::guard('client')->user()->id;
        $this->postRepo->createPost($client, $request->toArray());
        return redirect()->route('home');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $post = $this->postRepo->find($id);
        return view('home.posts.update',compact('post'));
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $this->postRepo->update($id, $request->toArray());
        return redirect()->back();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->postRepo->delete($id);
        return redirect()->back();
    }
}
