<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Cheer;
use App\Repositories\Contracts\RepositoryInterface\CheerRepositoryInterface;
use App\Repositories\BaseRepository;

class CheerRepository extends BaseRepository implements CheerRepositoryInterface
{
    public function getModel()
    {
        return Cheer::class;
    }
}
