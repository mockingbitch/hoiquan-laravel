<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\CheerRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ClientRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CommentRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\PostRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\TagRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
     * @return Response
     */
    public function index() : Response
    {
//        $post = Post::with('client')->get();
        $client = Auth::guard('client')->user();
        $posts = $this->postRepo->getAll();
        $comments = $this->commentRepo->getAll();
        $cheers = $this->cheerRepo->getAll();
        $tags = $this->tagRepo->getAll();

        return $this->successResponse([
            'client'=>$client,
            'posts'=>$posts,
            'comments'=>$comments,
            'cheers'=>$cheers,
            'tags'=>$tags
        ],
            'Get all',
            200);
    }
}
