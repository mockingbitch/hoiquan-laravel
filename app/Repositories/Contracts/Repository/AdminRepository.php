<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Admin;
use App\Repositories\Contracts\RepositoryInterface\AdminRepositoryInterface;
use App\Repositories\BaseRepository;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function getModel()
    {
        return Admin::class;
    }
}
