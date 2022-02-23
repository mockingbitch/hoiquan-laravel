<?php

namespace App\Services;

use App\Models\Cheer;
use App\Models\Post;
use App\Repositories\Contracts\RepositoryInterface\CheerRepositoryInterface;

class CheerService
{
    /**
     * @var CheerRepositoryInterface
     */
    private $cheerRepo;

    /**
     * @param CheerRepositoryInterface $cheerRepository
     */
    public function __construct(CheerRepositoryInterface $cheerRepository)
    {
        $this->cheerRepo = $cheerRepository;
    }

    /**
     * @param $client
     * @param $post
     *
     * @return void
     */
    public function cheer($client, $post)
    {
        $cheers = Cheer::where('post', $post)->get();

        if ($cheers->isEmpty()) {
            Cheer::create([
                'client' => $client,
                'post' => $post,
                'isCheer' => 1
            ]);
        }
//        else if (isset($cheers))
        else {
            foreach ($cheers as $cheer) {
                if ($cheer->client == $client) {
                    $match = [
                        'post' => $post,
                        'client' => $client
                    ];

                    if ($cheer->isCheer == 0) {
                        Cheer::where($match)->update(['isCheer'=>1]);

                    }

                    else {
                        Cheer::where($match)->update(['isCheer'=>0]);
                    }
                }

                else {
                    Cheer::create([
                        'client' => $client,
                        'post' => $post,
                        'isCheer' => 1
                    ]);
                }
            }
        }
        $cheerss = Cheer::where([
            'post' => $post,
            'isCheer' => 1
        ])->get();
        $cheerCount = count($cheerss);
        Post::where('id', $post)->update(['cheers'=>$cheerCount]);
    }
}
