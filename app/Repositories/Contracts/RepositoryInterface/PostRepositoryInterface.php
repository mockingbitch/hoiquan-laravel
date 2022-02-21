<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface PostRepositoryInterface extends BaseRepositoryInterface
{
    public function createPost($client, $request =[]);

    public function getAllPost();
}
