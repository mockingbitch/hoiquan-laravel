<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\ClientRepositoryInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientManagerController extends Controller
{
    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepo;

    /**
     * @param ClientRepositoryInterface $clientRepository
     */
    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepo = $clientRepository;
    }

    /**
     * @return Response
     */
    public function index() : Response
    {
        $clients = $this->clientRepo->getAll();

        if (null == $clients) {
            return $this->errorResponse('Could not find clients',404);
        }

        return $this->successResponse(['clients'=>$clients],'Get all',200);
    }

    public function show(int $id) : Response
    {
        $client = $this->clientRepo->find($id);

        if (null == $client) {
            return $this->errorResponse('Could not find client',404);
        }

        return $this->successResponse(['client'=>$client],'Get client',200);
    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function delete(int $id) : Response
    {
        $client = $this->clientRepo->find($id);

        if (null == $client) {
            return $this->errorResponse('Could not find client',404);
        }

        $this->clientRepo->delete($id);

        return $this->successResponse([],'Deleted successfully',200);
    }
}
