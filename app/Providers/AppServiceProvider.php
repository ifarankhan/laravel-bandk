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
use App\Repositories\ModulesInterface;
use App\Repositories\ModulesRepository;
use App\Repositories\RolesInterface;
use App\Repositories\RolesRepository;
use App\Repositories\UserInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        $this->app->singleton(ClaimInterface::class, ClaimRepository::class);
        $this->app->singleton(AddressesInterface::class, AddressesRepository::class);
        $this->app->singleton(ClaimMechanicsInterface::class, ClaimMechanicsRepository::class);
        $this->app->singleton(ClaimTypesInterface::class, ClaimTypesRepository::class);
        $this->app->singleton(DepartmentsInterface::class, DepartmentsRepository::class);
        $this->app->singleton(UserInterface::class, UserRepository::class);
        $this->app->singleton(RolesInterface::class, RolesRepository::class);
        $this->app->singleton(ModulesInterface::class, ModulesRepository::class);
    }
}
