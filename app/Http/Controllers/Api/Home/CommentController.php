<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
     * @return Response
     */
    public function create(Request $request) : Response
    {
        $post = $request->query('post');
        $client = Auth::guard('client')->user();

        if (!isset($client)) {
            return $this->errorResponse('Please login to comment',200);
        }

        $clientId = $client->id;
        $comment = $this->commentRepo->createComment($clientId, $post, $request->toArray());

        return $this->successResponse(['comment'],'Created',201);
    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function show(int $id) : Response
    {
        $comment = $this->commentRepo->find($id);

        if (!isset($comment)) {
            return $this->errorResponse('Could not find comment',200);
        }

        return $this->successResponse(['comment'=>$comment],'Get comment',200);
    }

    /**
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update(int $id, Request $request) : Response
    {
        $client = Auth::guard('client')->user();

        if (!isset($client)) {
            return $this->errorResponse('Please login to comment',200);
        }

        $clientId = $client->id;
        $clientComment = $this->commentRepo->find($id)->client;

        if (!isset($clientComment)) {
            return $this->errorResponse('Something went wrong', 404);
        }

        if ($clientComment == $clientId) {
            $comment = $this->commentRepo->update($id, $request->toArray());
        }

       return $this->successResponse(['comment'=>$comment],'Updated Successfully',200);
    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function delete(int $id) : Response
    {
        $client = Auth::guard('client')->user();

        if (!isset($client)) {
            return response()->json(['msg'=>'Something went wrong'],404);
        }

        $clientId = $client->id;
        $clientComment = $this->commentRepo->find($id)->client;

        if (!isset($clientComment)) {
            return response()->json(['msg'=>'Something went wrong'],404);
        }

        if ($clientComment == $clientId) {
            $this->commentRepo->delete($id);
        }

        return response()->json(['msg'=>'Deleted successfully'],200);
    }
}
