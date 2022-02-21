<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepo;

    /**
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepo = $commentRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('home.comments.add');
    }

    /**
     * @param $post
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($post, Request $request)
    {
        $client = Auth::guard('client')->user()->id;
        $this->commentRepo->createComment($client,$post,$request->toArray());

        return redirect()->back();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $this->commentRepo->find($id);

        return view('home.comments.update');
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $client = Auth::guard('client')->user()->id;
        $clientComment = $this->commentRepo->find($id)->client;
        if ($clientComment == $client)
        {
            $this->commentRepo->update($id, $request->toArray());
        }

        return redirect()->back();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $client = Auth::guard('client')->user()->id;
        $clientComment = $this->commentRepo->find($id)->client;
        if ($clientComment == $client)
        {
            $this->commentRepo->delete($id);
        }

        return redirect()->back();
    }
}
