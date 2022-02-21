<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\CheerRepositoryInterface;
use App\Services\CheerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @param CheerRepositoryInterface $cheerRepository
     * @param CheerService $cheerService
     */
    public function __construct(
        CheerRepositoryInterface $cheerRepository,
        CheerService $cheerService
    )
    {
        $this->cheerRepo = $cheerRepository;
        $this->cheerService = $cheerService;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cheering($post)
    {
        $client = Auth::guard('client')->user()->id;
        $this->cheerService->cheer($client, $post);

        return redirect()->back();
    }

}
