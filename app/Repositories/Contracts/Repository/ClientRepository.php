<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Client;
use App\Repositories\Contracts\RepositoryInterface\ClientRepositoryInterface;
use App\Repositories\BaseRepository;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{
    public function getModel()
    {
        return Client::class;
    }
}
