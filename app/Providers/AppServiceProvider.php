<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public $bindings = [
        \App\Repositories\Contracts\RepositoryInterface\TagRepositoryInterface::class
        =>\App\Repositories\Contracts\Repository\TagRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\CommentRepositoryInterface::class
        =>\App\Repositories\Contracts\Repository\CommentRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\CheerRepositoryInterface::class
        =>\App\Repositories\Contracts\Repository\CheerRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\ClientRepositoryInterface::class
        =>\App\Repositories\Contracts\Repository\ClientRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\PostRepositoryInterface::class
        =>\App\Repositories\Contracts\Repository\PostRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\AdminRepositoryInterface::class
        =>\App\Repositories\Contracts\Repository\AdminRepository::class
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
