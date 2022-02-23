<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @return Response
     */
    public function index() : Response
    {
        $posts = $this->postRepo->getAll();

        if (!isset($posts)) {
            return response()->json(['msg'=>'Could not find post'],200);
        }

        return $this->successResponse(['posts'=>$posts],'Success',200);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request) : Response
    {
        $client = Auth::guard('client')->user();

        if (!isset($client)) {
            return response()->json(['msg'=>'Please login to create post'],200);
        }

        $clientId = $client->id;
        $post = $this->postRepo->createPost($clientId, $request->toArray());

        return $this->successResponse(['post'=>$post],'Created a post',201);
    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function show(int $id) : Response
    {
        $post = $this->postRepo->find($id);

        if (!isset($post)) {
            return $this->errorResponse('Could not find post',404);
        }

        return $this->successResponse(['post'=>$post],'Get post',200);
    }

    /**
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update(int $id, Request $request) : Response
    {
        $post = $this->postRepo->find($id);

        if (!isset($post)) {
            return $this->errorResponse('Could not find post',404);
        }

        $post = $this->postRepo->update($id, $request->toArray());

        return $this->successResponse(['post'=>$post],'Updated successfully',200);
    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function delete(int $id) : Response
    {
        $post = $this->postRepo->find($id);

        if (!isset($post)) {
            return $this->errorResponse('Could not find post',404);
        }

        $this->postRepo->delete($id);

        return $this->successResponse([],'Deleted successfully',200);
    }
}
