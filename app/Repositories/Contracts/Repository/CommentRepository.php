<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Comment;
use App\Repositories\Contracts\RepositoryInterface\CommentRepositoryInterface;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function getModel()
    {
        return Comment::class;
    }

    public function createComment($client, $post, $request)
    {
        $data = [
            'post' => $post,
            'client' => $client,
            'content'=>$request['content']
        ];

        return $this->model->create($data);
    }
}
