<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Core\UseCase\Interfaces\TransactionInterface;
use Core\Domain\Repository\FileRepositoryInterface;

use App\Repositories\Upload\UploadLocalRepository;
use App\Repositories\Transaction\DatabaseTransaction;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(
            FileRepositoryInterface::class,
            UploadLocalRepository::class,
        );

        # DB Transaction:
        $this->app->bind(
            TransactionInterface::class,
            DatabaseTransaction::class,
        );
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
    }
}
