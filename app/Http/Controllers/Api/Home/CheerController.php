<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\CheerRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\PostRepositoryInterface;
use App\Services\CheerService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheerController extends Controller
{
    /**
     * @var CheerRepositoryInterface
     */
    private $cheerRepo;

    /**
     * @var CheerService
     */
    private $cheerService;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepo;

    /**
     * @param CheerRepositoryInterface $cheerRepository
     * @param CheerService $cheerService
     */
    public function __construct(
        CheerRepositoryInterface $cheerRepository,
        CheerService $cheerService,
        PostRepositoryInterface $postRepo
    )
    {
        $this->cheerRepo = $cheerRepository;
        $this->cheerService = $cheerService;
        $this->postRepo = $postRepo;
    }

    /**
     * @param int $post
     *
     * @return Response
     */
    public function cheering(int $post) : Response
    {
        $post = $this->postRepo->find($post);

        if (null == $post) {
            return $this->errorResponse('Could not find post', 404);
        }

        $client = Auth::guard('client')->user()->id;
        $this->cheerService->cheer($client, $post);

        return $this->successResponse([], 'Cheering', 200);
    }

}
