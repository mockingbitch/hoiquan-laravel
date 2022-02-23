<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\TagRepositoryInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    /**
     * @var TagRepositoryInterface
     */
    private $tagRepo;

    /**
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepo = $tagRepository;
    }

    /**
     * @return Response
     */
    public function index() : Response
    {
        $tags = $this->tagRepo->getAll();

        if (null == $tags) {
            return $this->errorResponse('Something went wrong, null given',404);
        }

        return $this->successResponse(['tags'=>$tags], 'get all', 200);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request) : Response
    {
        $tag = $this->tagRepo->create($request->toArray());

        return $this->successResponse(['tag'=>$tag], 'Created', 201);
    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function show(int $id) : Response
    {
        $tag = $this->tagRepo->find($id);

        if (null !== $tag) {
            return $this->errorResponse('Something went wrong, null given', 404);
        }

        return $this->successResponse(['tag'=>$tag], 'Ok', 200);
    }

    /**
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update(int $id, Request $request) : Response
    {
        $tag = $this->tagRepo->find($id);

        if (null == $tag) {
            return $this->errorResponse('Could not find tag',404);
        }

        $tag = $this->tagRepo->update($id,$request->toArray());

        return $this->successResponse(['tag'=>$tag], 'Updated Successfully', 200);
    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function delete(int $id) : Response
    {
        $tag = $this->tagRepo->find($id);

        if (null == $tag) {
            return $this->errorResponse('Could not find tag',404);
        }

        $this->tagRepo->delete($id);

        return $this->successResponse([],'Deleted Successfully, 200');
    }
}
