<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Post;
use App\Repositories\Contracts\RepositoryInterface\PostRepositoryInterface;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return Post::class;
    }

    /**
     * @param $client
     * @param $request
     *
     * @return mixed
     */
    public function createPost($client, $request =[])
    {
        $data = [
          'title'=>$request['title'],
            'tag'=>$request['tag'],
            'client'=>$client,
            'content'=>$request['content'],
            'slug' => 'abc'
        ];

        return $this->model->create($data);
    }

    public function getAllPost()
    {
        return $this->model->leftJoin('comments','posts.id','=','comments.post')
            ->leftJoin('cheers','posts.id','=','cheers.post')
            ->select([
                'posts.title',
                'posts.content as p_content',
                'posts.slug',
                'posts.featured_image',
                'posts.status',
                'posts.cheers',
                'comments.content as cm_content'
            ])
            ->get();;
    }
}
