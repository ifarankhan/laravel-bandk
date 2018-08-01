<?php

namespace App\Providers;

use App\Repositories\AddressesInterface;
use App\Repositories\AddressesRepository;
use App\Repositories\ClaimInterface;
use App\Repositories\ClaimMechanicsInterface;
use App\Repositories\ClaimMechanicsRepository;
use App\Repositories\ClaimRepository;
use App\Repositories\ClaimTypesInterface;
use App\Repositories\ClaimTypesRepository;
use App\Repositories\DepartmentsInterface;
use App\Repositories\DepartmentsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ClaimInterface::class, ClaimRepository::class);
        $this->app->singleton(AddressesInterface::class, AddressesRepository::class);
        $this->app->singleton(ClaimMechanicsInterface::class, ClaimMechanicsRepository::class);
        $this->app->singleton(ClaimTypesInterface::class, ClaimTypesRepository::class);
        $this->app->singleton(DepartmentsInterface::class, DepartmentsRepository::class);
    }
}
