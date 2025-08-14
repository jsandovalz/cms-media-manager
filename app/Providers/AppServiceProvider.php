<?php

namespace App\Providers;

use App\Media\Interfaces\MediaRepositoryInterface;
use App\Media\Interfaces\MediaValidatorInterface;
use App\Media\Repositories\MemoryMediaRepository;
use App\Media\Validators\MediaValidator;
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
        $this->app->singleton(MediaRepositoryInterface::class,MemoryMediaRepository::class);
        $this->app->singleton(MediaValidatorInterface::class, MediaValidator::class );
        $this->app->singleton(MemoryMediaRepository::class, function () {
        $path = storage_path('app/media_store.json');
        return new MemoryMediaRepository($path);
    });

    }

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
