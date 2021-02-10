<?php

namespace App\Providers;

use App\Repository\BaseRepository;
use App\Repository\BooksRepository;
use App\Repository\IBooksRepository;
use App\Repository\IEloquentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    // /**
    //  * Bootstrap services.
    //  *
    //  * @return void
    //  */
    public function boot()
    {
        $this->app->bind(IEloquentRepository::class, BaseRepository::class);
        $this->app->bind(IBooksRepository::class, BooksRepository::class);           
    }
}
