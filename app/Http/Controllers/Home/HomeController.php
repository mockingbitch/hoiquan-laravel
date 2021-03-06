<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Repositories\Contracts\RepositoryInterface\CheerRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ClientRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CommentRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\PostRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\TagRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var $postRepo
     */
    private $postRepo;

    /**
     * @var $clientRepo
     */
    private $clientRepo;

    /**
     * @var $cheerRepo
     */
    private $cheerRepo;

    /**
     * @var $commentRepo
     */
    private $commentRepo;

    /**
     * @var $tagRepo
     */
    private $tagRepo;

    /**
     * @param PostRepositoryInterface $postRepo
     * @param ClientRepositoryInterface $clientRepo
     * @param CheerRepositoryInterface $cheerRepo
     * @param CommentRepositoryInterface $commentRepo
     * @param TagRepositoryInterface $tagRepo
     */
    public function __construct(
        PostRepositoryInterface $postRepo,
        ClientRepositoryInterface $clientRepo,
        CheerRepositoryInterface $cheerRepo,
        CommentRepositoryInterface $commentRepo,
        TagRepositoryInterface $tagRepo
    )
    {
        $this->postRepo = $postRepo;
        $this->clientRepo = $clientRepo;
        $this->cheerRepo = $cheerRepo;
        $this->commentRepo = $commentRepo;
        $this->tagRepo = $tagRepo;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
//        $post = Post::with('client')->get();
        $client = Auth::guard('client')->user();
//        $posts = $this->postRepo->getAllPost();
        $posts = $this->postRepo->getAll();
        $comments = $this->commentRepo->getAll();
        $cheers = $this->cheerRepo->getAll();
        $tags = $this->tagRepo->getAll();

        return view('home.home', compact([
            'posts', 'client', 'comments', 'cheers', 'tags'
        ]));
//        return response()->json([
////            'client' => $client,
//            'posts' => $posts,
//        ], 200);
    }
}
