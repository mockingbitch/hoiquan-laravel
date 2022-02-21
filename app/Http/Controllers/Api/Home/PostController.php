<?php

namespace App\Http\Controllers\Api\Home;

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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = $this->postRepo->getAll();
        if (!isset($posts))
        {
            return response()->json(['msg'=>'Could not find post'],200);
        }

        return response()->json([
            'posts'=>$posts
        ],200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $client = Auth::guard('client')->user()->id;
        if (!isset($client))
        {
            return response()->json(['msg'=>'Please login to create post'],200);
        }
        $post = $this->postRepo->createPost($client, $request->toArray());

        return response()->json([
            'post'=>$post,
            'msg'=>'Created'
        ],201);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = $this->postRepo->find($id);
        if (!isset($post))
        {
            return response()->json(['msg'=>'Could not find post'],200);
        }

        return response()->json(['post'=>$post],200);
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $post = $this->postRepo->find($id);
        if (!isset($post))
        {
            return response()->json(['msg'=>'Could not find post'],200);
        }
        $post = $this->postRepo->update($id, $request->toArray());

        return response()->json(['post'=>$post],200);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $post = $this->postRepo->find($id);
        if (!isset($post))
        {
            return response()->json(['msg'=>'Could not find post'],200);
        }
        $this->postRepo->delete($id);

        return response()->json([
            'post'=>$post,
            'msg'=>'Delete successfully'
        ],200);
    }
}
