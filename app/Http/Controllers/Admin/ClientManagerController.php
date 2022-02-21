<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\ClientRepositoryInterface;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $clients = $this->clientRepo->getAll();

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $this->clientRepo->delete($id);

        return redirect()->back();
    }
}
