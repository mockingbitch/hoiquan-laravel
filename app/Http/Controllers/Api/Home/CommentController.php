<?php

namespace App\Http\Controllers\Api\Home;

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
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create( Request $request)
    {
        $post = $request->query('post');
        $client = Auth::guard('client')->user()->id;
        if (!isset($client))
        {
            return response()->json(['msg'=>'Please login to comment'],200);
        }
        $comment = $this->commentRepo->createComment($client,$post,$request->toArray());

        return response()->json([
            'comment'=>$comment,
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
        $comment = $this->commentRepo->find($id);
        if (!isset($comment))
        {
            return response()->json(['msg'=>'Could not find comment'],200);
        }

        return response()->json([
            'comment'=>$comment
        ],200);
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $client = Auth::guard('client')->user()->id;
        if (!isset($client))
        {
            return response()->json(['msg'=>'Please login to comment'],200);
        }
        $clientComment = $this->commentRepo->find($id)->client;
        if (!isset($clientComment))
        {
            return response()->json(['msg'=>'Something went wrong'],404);
        }
        if ($clientComment == $client)
        {
            $comment = $this->commentRepo->update($id, $request->toArray());
        }

        return response()->json([
            'comment'=>$comment,
            'msg'=>'Updated'
        ],200);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $client = Auth::guard('client')->user()->id;
        if (!isset($client))
        {
            return response()->json(['msg'=>'Something went wrong'],404);
        }
        $clientComment = $this->commentRepo->find($id)->client;
        if (!isset($clientComment))
        {
            return response()->json(['msg'=>'Something went wrong'],404);
        }
        if ($clientComment == $client)
        {
            $this->commentRepo->delete($id);
        }

        return response()->json(['msg'=>'Deleted successfully'],200);
    }
}
