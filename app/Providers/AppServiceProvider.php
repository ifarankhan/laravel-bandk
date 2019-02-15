<?php

namespace App\Providers;

use App\Repositories\AddressesInterface;
use App\Repositories\AddressesRepository;
use App\Repositories\CategoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\ClaimConversationInterface;
use App\Repositories\ClaimConversationRepository;
use App\Repositories\ClaimInterface;
use App\Repositories\ClaimMechanicsInterface;
use App\Repositories\ClaimMechanicsRepository;
use App\Repositories\ClaimRepository;
use App\Repositories\ClaimTypesInterface;
use App\Repositories\ClaimTypesRepository;
use App\Repositories\ContentInterface;
use App\Repositories\ContentRepository;
use App\Repositories\CustomerInterface;
use App\Repositories\CustomerRepository;
use App\Repositories\DepartmentsInterface;
use App\Repositories\DepartmentsRepository;
use App\Repositories\ModulesInterface;
use App\Repositories\ModulesRepository;
use App\Repositories\RolesInterface;
use App\Repositories\RolesRepository;
use App\Repositories\TeamsInterface;
use App\Repositories\TeamsRepository;
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

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        require_once app_path() . '/Helper/helper.php';

        $this->app->singleton(ClaimInterface::class, ClaimRepository::class);
        $this->app->singleton(AddressesInterface::class, AddressesRepository::class);
        $this->app->singleton(ClaimMechanicsInterface::class, ClaimMechanicsRepository::class);
        $this->app->singleton(ClaimTypesInterface::class, ClaimTypesRepository::class);
        $this->app->singleton(DepartmentsInterface::class, DepartmentsRepository::class);
        $this->app->singleton(UserInterface::class, UserRepository::class);
        $this->app->singleton(RolesInterface::class, RolesRepository::class);
        $this->app->singleton(ModulesInterface::class, ModulesRepository::class);
        $this->app->singleton(ContentInterface::class, ContentRepository::class);
        $this->app->singleton(ClaimConversationInterface::class, ClaimConversationRepository::class);
        $this->app->singleton(CategoryInterface::class, CategoryRepository::class);
        $this->app->singleton(CustomerInterface::class, CustomerRepository::class);
        $this->app->singleton(TeamsInterface::class, TeamsRepository::class);
    }
}
