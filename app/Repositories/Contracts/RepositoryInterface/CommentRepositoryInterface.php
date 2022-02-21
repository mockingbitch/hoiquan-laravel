<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface CommentRepositoryInterface extends BaseRepositoryInterface
{
    public function createComment($client, $post, $request);
}
